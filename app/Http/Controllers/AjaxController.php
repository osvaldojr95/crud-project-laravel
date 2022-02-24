<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\TiposPost;
use DataTables;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get($source, Request $request)
    {
        $return_type = "datatable";
        $result = null;
        $date = null;
        $source_file = null;
        $textNl2br = null;
        $result_view = null;

        switch ($source) {
            case "posts":
                $date = "created_at";
                $result = $this->getPosts($request);
                $source_file = "posts.action";
                break;

            case "tipospost":
                $date = "created_at";
                $result = $this->getTiposPost();
                $source_file = "tipospost.action";
                break;

            default:
                echo "<h1>Essa rota precisa de um parâmetro válido</h1>";
                break;
        }

        switch ($return_type) {

            case 'datatable':
                if (!$result) {
                    return '[]';
                }
                if ($date) {
                    $dataTable = DataTables::eloquent($result)
                        ->addColumn('action', $source_file)
                        ->editColumn(
                            $date,
                            function ($result) use ($date) {
                                return date('d/m/Y', strtotime($result->$date));
                            }
                        )
                        ->filterColumn(
                            $date,
                            function ($query, $keyword) use ($date) {
                                $query->whereRaw("DATE_FORMAT($date, '%d/%m/%Y') like ?", ["%$keyword%"]);
                            }
                        );
                    if ($source === 'ocorrencias' || $source === 'sales') {
                        $dataTable->addColumn('horario_sugerido_contato', function ($model) {
                            return $model->horario_sugerido_contato;
                        });
                    }

                    return $dataTable->make(true);
                }

                if ($textNl2br) {
                    return DataTables::eloquent($result)
                        ->addColumn('action', $source_file)
                        ->addColumn('horario_sugerido_contato', function ($model) {
                            return $model->horario_sugerido_contato;
                        })
                        ->editColumn(
                            $textNl2br,
                            function ($result) use ($textNl2br) {
                                return nl2br(str_replace(["\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"], "<br />",
                                    $result->$textNl2br));
                            }
                        )
                        ->filterColumn(
                            $textNl2br,
                            function ($query, $keyword) use ($textNl2br) {
                                $query->whereRaw("$textNl2br like ?", ["%$keyword%"]);
                            }
                        )
                        ->rawColumns([$textNl2br])
                        ->make(true);
                }

                if ($source === 'ocorrencias' || $source === 'sales') {
                    return DataTables::eloquent($result)
                        ->addColumn('action', $source_file)
                        ->addColumn('horario_sugerido_contato', function ($model) {
                            return $model->horario_sugerido_contato;
                        })
                        ->make(true);
                }
                return DataTables::eloquent($result)
                    ->addColumn('action', $source_file)
                    ->make(true);
            case 'datatable_of':
                if ($source === 'ocorrencias' || $source === 'sales') {
                    return DataTables::of($result)
                        ->addColumn('action', $source_file)
                        ->addColumn('horario_sugerido_contato', function ($model) {
                            return $model->horario_sugerido_contato;
                        })
                        ->make(true);
                }
                return DataTables::of($result)
                    ->addColumn('action', $source_file)
                    ->make(true);
            case 'plain':
                return $result;
            case 'json':
                return response()->json($result);
            case 'view':
                return view($result_view, compact('result'));

            default:
                echo "<h1>Formato inválido</h1>";
                break;
        }
    }

    private function getPosts(Request $request)
    {
        $tableName = $request['tablename'] ?? null;
        $filter_request = $request['filter'] ?? [];
        $whereFilter = [];

        foreach ($filter_request as $key => $filter) {
            $operator = (array_key_exists('operator', $filter) ? $filter['operator'] : null);
            $value = (array_key_exists('value', $filter) ? $filter['value'] : null);

            if ((strlen(trim($operator)) > 0) && strlen(trim($value)) > 0) {
                switch ($key) {
                    case 'tipospost.id':
                        $whereFilter[] = [$tableName . '.id',$operator, $value];
                        break;

                    default:
                        $key = 'posts.' . $key;
                        break;
                }
            }
        }

        $data = Post::select(array("posts.*", "tipospost.name as tipospost_name"))
            ->leftJoin("tipospost", 'posts.id_tipospost', '=', 'tipospost.id')
            ->where($whereFilter);

        $data = $data->limit(100);

        return $data;
    }

    private function getTiposPost()
    {
        return TiposPost::select("tipospost.*")->limit(100);
    }
}
