<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Excel;

class HomeController extends Controller
{
    public function index(){
    	return view('welcome');
    }
    public function ExcelFileUp(Request $request){


		    $path = $request->file('excel_file')->store('public/arquivos');

    		return response()
            ->json(['error' => 0, 'file_path' => $path]);
    }
    public function generatedSql(Request $request){
        // dd($request->file_path);
        $file_url = storage_path('app/'.$request->file_path);
        $sqlName = bcrypt(\Carbon\Carbon::now());
        
        $excel = app()->make('excel');
        
        $data  = $excel -> load($file_url,function($reader) use ($sqlName){
                $results = $reader->all();
                foreach($results->toArray() as $row){
                    
                     $sql = "insert into wp_post(post_title, post_content,post_name,post_type) values('".$row['titulo']."','".$row['descritivo_da_loja']."','".str_slug($row['titulo'])."','wpsl_stores')";
                     Storage::disk('local')->append('public/sql/'.$sqlName.'.sql', $sql);

                          $sql2 = "insert into wp_postmeta(post_id ,meta_key,meta_value) values 
                                                               (500,'wpsl_address','".$row['endereco']."'),
                                                               (500,'wpsl_city','".$row['cidade']."'),
                                                               (500,'wpsl_country','".$row['pais']."'),
                                                               (500,'wpsl_country_iso','BR'),
                                                               (500,'wpsl_lat','".$row['latitude']."'),
                                                               (500,'wpsl_lng','".$row['longitude']."')"; 
                     Storage::disk('local')->append('public/sql/'.$sqlName.'.sql', $sql2);
                }

        })->get();
        return response()
            ->json(['error' => 0, 'sql_download' => 'sql/'.$sqlName.'.sql']);    
    }

    public function downloadSql(Request $request){
        $file_url = storage_path('app/public/'.$request->storage_file);
        return response()->download($file_url);
    }
}
