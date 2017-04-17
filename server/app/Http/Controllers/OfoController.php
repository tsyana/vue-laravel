<?php

namespace App\Http\Controllers;

use App\Model\Ofo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Sunra\PhpSimple\HtmlDomParser;


class OfoController extends Controller
{
    public static $NAME = 'QD';
    /**
     * todo :
     * 接口分页， 智能连接
     */
    public function doFetch(Request $request) {
        if(!$request->cid){
            $categoryId = 0;
        }else {
            $categoryId = $request->cid;
        }
        // $this->parseRequest($categoryId);
        return;
    }

    public function getPassword(Request $request){
      $result = Ofo::where('bikeId',$request->id)->get();
      return $result;
    }

    public function getCategory( ) {
        return [
            ['name'=>'热门', 'value' => '0'],
            ['name'=>'推荐', 'value' => '1'],
            ['name'=>'段子手', 'value' => '2'],
            ['name'=>'养生堂', 'value' => '3'],
            ['name'=>'私房话', 'value' => '4'],
            ['name'=>'八卦精', 'value' => '5'],
            ['name'=>'爱生活', 'value' => '6'],
            ['name'=>'财经迷', 'value' => '7'],
            ['name'=>'汽车迷', 'value' => '8'],
            ['name'=>'潮人帮', 'value' => '9'],
            ['name'=>'科技咖', 'value' => '10'],
            ['name'=>'辣妈帮', 'value' => '11'],
            ['name'=>'点赞党', 'value' => '12'],
            ['name'=>'旅行家', 'value' => '13'],
            ['name'=>'职场人', 'value' => '14'],
            ['name'=>'美食家', 'value' => '15'],
            ['name'=>'古今通', 'value' => '16'],
            ['name'=>'学霸族', 'value' => '17'],
            ['name'=>'星座控', 'value' => '18'],
            ['name'=>'体育迷', 'value' => '19']
        ];
    }

}
