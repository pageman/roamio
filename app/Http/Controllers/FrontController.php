<?php namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use App\Tag;

class FrontController extends Controller {

    public function getByHighestRating()
    {
        $entries = Entry::with('locations')
                        ->with('participants')
            ->with('tags')
            ->with('days')
            ->with('hours')
            ->orderBy('rating','desc')->get();
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Credentials: true ");
      header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
      header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
          X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
        return $entries->toJson();
    }

    public function getByCreatedAt()
    {
         $entries = Entry::with('locations')
                         ->with('participants')
            ->with('tags')
            ->with('days')
            ->with('hours')
            ->orderBy('created_at','desc')->get();
            header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Credentials: true ");
      header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
      header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
          X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
      
         return $entries->toJson();
    } 

    public function getById($id)
    {
            $entries = Entry::with('locations')
                         ->with('participants')
            ->with('tags')
            ->with('days')
            ->with('hours')
            ->where('id',$id)
            ->orderBy('created_at','desc')->get(); 
            header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Credentials: true ");
      header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
      header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
          X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
      
         return $entries->toJson();

    }

    public function search(Request $request){
      $searchTerm = is_null($request->input('query')) ? "" : $request->input('query');
      $city = is_null($request->input('city')) ? '' : $request->input('city');
      $category = is_null($request->input('category')) ? "" : $request->input('category');
      $participants = is_null($request->input('participants')) ? "" : $request->input('participants');
      $min = is_null($request->input('min_budget')) ? 0 : $request->input('min_budget');
      $max = is_null($request->input('max_budget'))? 2147483647 : $request->input('max_budget');
      $entries = Entry::where('title','LIKE',"%$searchTerm%")->where('city','LIKE',"%$city%")->where('address','LIKE',"%$city%")->where('categories',"LIKE","%$category%")->where('participants','LIKE',"%$participants%")->where('budget','>=', $min)->where('budget','<=',$max)->with('days')->with('hours')->with('tags');

      /*if($searchTerm != ''){
          $entries = Entry::where('title','LIKE',"%$searchTerm%");
      } else if($city != ''){
          $entries = $entries->where('description','LIKE',"%$searchTerm%");
      } else if($category != ''){
          $entries = $entries->where('categories','LIKE',"%$categories%");
      } else if($participants != ''){
          $entries = $entries->where('participants','LIKE',"");
      }*/

      $entries = $entries->get();
      $tags = Tag::where('description','LIKE',"%$searchTerm%")->get();
      
      foreach($tags as $tag){
        $entries->merge($tag->entry()->get());
      }

      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Credentials: true ");
      header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
      header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
          X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
      

      return $entries->toJson();
    }
}
