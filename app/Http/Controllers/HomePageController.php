<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\NavMenu;
use App\Models\OurServicesModel;
use App\Models\TestimonialsModel;
use App\Models\AboutUsModel;
use App\Models\ProductModel;
use App\Models\BlogModel;
use App\Models\ReportModel;
use App\Models\SettingModel;
use App\Models\FaqModel;
use App\Models\PartnersModel;
use App\Models\TeamModel;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;
use DB;

class HomePageController extends Controller
{
    use CommonFunctions;

    public function homePage(){
         try{
            $service = OurServicesModel::all();
             $aboutText =AboutUsModel::get();
             $getAllProduts =ProductModel::all();
             $testimonial = DB::table('testimonials')->where('approval_status','approved')->get();
            $slider = DB::table('slider')->get();
            $getChairManData =  DB::table('team')->where('post',"LIKE","%Founder%")->get();
             $our_offers = (new OurOffersController())->getHomePageOffers();
              $Recognitions   = PartnersModel::where('image_type','2')->get();
             $partnersImages   = PartnersModel::where('image_type','1')->get();
             $WebSetting = SettingModel::all();
             return view("HomePage.dynamicHomePage",compact("our_offers","service","testimonial","slider","aboutText","getChairManData","getAllProduts","partnersImages","Recognitions","WebSetting"));
        }catch(Exception $exception){
            echo $exception->getMessage();
            return false;
        }

    }
    public function aboutUs(){
    $WebSetting = SettingModel::all();
    $Recognitions = PartnersModel::where('image_type', '2')->get();
    $aboutText = AboutUsModel::get();

    // Fetch all team members instead of filtering by specific posts
    $teamData = TeamModel::all();

    return view("HomePage.aboutUs", compact("WebSetting", "Recognitions", "aboutText", "teamData"));
}
    public function termsConditions(){
        $WebSetting = SettingModel::all();

        return view("HomePage.termsConditions",compact("WebSetting"));
    }
    public function shippingDeliverypolicy(){
        $WebSetting = SettingModel::all();

        return view("HomePage.shippingDeliverypolicy",compact("WebSetting"));
    }
    public function CancellationRefundPolicy(){
        $WebSetting = SettingModel::all();

        return view("HomePage.CancellationRefundPolicy",compact("WebSetting"));
    }
    public function privacyPolicy(){
        $WebSetting = SettingModel::all();

        return view("HomePage.privacyPolicy",compact("WebSetting"));
    }
    public function destinations(){
        $WebSetting = SettingModel::all();

        $service = OurServicesModel::all();
        $Recognitions   = PartnersModel::where('image_type','2')->get();

         return view("HomePage.destinations",compact('WebSetting','service','Recognitions'));
    }
    public function productPage(){
        $WebSetting = SettingModel::all();

        $getAllProduts =ProductModel::all();
        $Recognitions   = PartnersModel::where('image_type','2')->get();

         return view("HomePage.productPage",compact("WebSetting","Recognitions","getAllProduts"));
    }

     public function EmployerPage(){
       
         return view("HomePage.EmployerPage");
    }
    public function reportPage(){
        $WebSetting = SettingModel::all();

         $repots =ReportModel::all();
        $Recognitions   = PartnersModel::where('image_type','2')->get();

          return view("HomePage.reportPage",compact("WebSetting","Recognitions","repots"));
    }
    public function blogPage(){
        $WebSetting = SettingModel::all();

       $getAllBlogs = BlogModel::all();
       $getAllFaq = FaqModel::orderBy('created_at', 'asc')->get();
       $Recognitions   = PartnersModel::where('image_type','2')->get();

        return view("HomePage.blogPage",compact("WebSetting","getAllBlogs","getAllFaq","Recognitions"));
    }
    public function galleryPages(){
        // $data["galleryImages"] =$this->getCachedGalleryItems();
        // $data[GalleryItem::FILTER_CATEGORY] = collect($data["galleryImages"])->unique(GalleryItem::FILTER_CATEGORY);
        $ImageMOdule = new GalleryItem();
        $WebSetting = SettingModel::all();

        $Recognitions   = PartnersModel::where('image_type','2')->get();

        $galleryImages = $ImageMOdule->getAllGalleryImages();

        return view("HomePage.galleryPages",compact("WebSetting","galleryImages","Recognitions"));
    }
    public function contactUs(){
        $WebSetting = SettingModel::all();

        $Recognitions   = PartnersModel::where('image_type','2')->get();

        return view("HomePage.contactUs",compact("Recognitions","WebSetting"));
    }
    public function ComingSoon(){
        $WebSetting = SettingModel::all();

        return view("HomePage.ComingSoon",compact("WebSetting"));
    }

    public function getMenu(){

        $menuItems = NavMenu::where([
            [NavMenu::STATUS,1],
            [NavMenu::VIEW_IN_LIST,NavMenu::VIEW_IN_LIST_YES]])
        ->select(NavMenu::TITLE,NavMenu::URL,NavMenu::URL_TARGET,NavMenu::PARENT_ID,
        NavMenu::NAV_TYPE,NavMenu::POSITION,NavMenu::ID)
        ->orderBy(NavMenu::PARENT_ID,"asc")
        ->orderBy(NavMenu::POSITION,"asc")->get();
        $returnData = [];
        if(count($menuItems)){
            // Nav Menu By Type
            $menuItemTypes = collect($menuItems)->groupBy(NavMenu::NAV_TYPE)->toArray();

            foreach($menuItemTypes as $navType=>$val){
                //for each type item
                foreach($val as $item){
                    if(!filter_var($item[NavMenu::URL], FILTER_VALIDATE_URL)){
                        $item[NavMenu::URL] = url("")."/".$item[NavMenu::URL];
                        //dd(url("items"));
                    }
                    //parent id is null
                    if($item[NavMenu::PARENT_ID]==null && !isset($returnData[$navType][$item[NavMenu::ID]])){
                        $returnData[$navType][$item[NavMenu::ID]] = $item;
                    }
                    //if parent id is set i.e child node
                    if($item[NavMenu::PARENT_ID]){
                        $this->setChildren($returnData,$item);
                    }
                }
            }
            if(count($returnData)){
                $return = ["status"=>true,"message"=>"menu items found.","data"=>$returnData,
                "menu_html"=>$this->getHtml($returnData)];
            }else{
                $return = ["status"=>false,"message"=>"menu items not found.","data"=>null];
            }
        }else{
            $return = ["status"=>false,"message"=>"menu items not set","data"=>null];
        }
        return response()->json($return);
    }

    public function setChildren(&$returnData,$item){

        foreach($returnData as $navType=>$navItem){
            //parent id matches
            if($navType==$item[NavMenu::NAV_TYPE] && !empty($navItem[$item[NavMenu::PARENT_ID]])){
                $returnData[$item[NavMenu::NAV_TYPE]][$item[NavMenu::PARENT_ID]]["child_node"][] = $item;
                return true;
            }
            if(!empty($returnData[$item[NavMenu::NAV_TYPE]])){

                $this->findSetChild($returnData[$item[NavMenu::NAV_TYPE]],$item);
            }

        }


    }

    /**
     * findSetChild
     *
     * @param  mixed $item
     * @param  mixed $itemSet
     * @return void
     */
    public function findSetChild(&$item,$itemSet){
        try{
            foreach($item as $navId=>$navItem){
                if($navItem[NavMenu::ID]==$itemSet[NavMenu::PARENT_ID]){
                    $item[$navId]["child_node"][] = $itemSet;
                    return true;
                }
                if(!empty($item[$navId]["child_node"])){
                    return $this->findSetChild($item[$navId]["child_node"],$itemSet);
                }
            }
        }catch(Exception $exception){
            return false;
        }
    }

    /**
     * getHtml
     *
     * @param  mixed $returnData
     * @return void
     */
    public function getHtml($returnData){
        $html = [];
        foreach($returnData as $key=>$value){
            if(!isset($html[$key])){
                $html[$key] = '';
            }
            foreach($value as $keyVal){
                $html[$key] .= $this->getItemHTML($key,$html,$keyVal);
            }
            //$html[$key] = $this->getItemHTML($key,$html,$value);
        }
        return $html;
    }

    /**
     * getItemHTML
     *
     * @param  mixed $key
     * @param  mixed $html
     * @param  mixed $item
     * @return void
     */
    public function getItemHTML($key,$html,$item){

        $link_html = "";
        if($key=="top"){
            if(!empty($item["child_node"])){

                $subMenu = $this->getItemChildHTML($item,'<div class="dropdown-menu">');
                $link_html .= '<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                        '.$item[NavMenu::TITLE].'
                                    </a>'.$subMenu.'</div>
                                    </li>';
            }else{
                $link_html .= '<li class="nav-item">
                                    <a target="'.$item[NavMenu::URL_TARGET].'" class="nav-link js-scroll-trigger" href="'.
                                    $item[NavMenu::URL].'">'.$item[NavMenu::TITLE].'</a>
                               </li>';
            }
        }

        return $link_html;
    }

    /**
     * getItemChildHTML
     *
     * @param  mixed $item
     * @param  mixed $html
     * @return void
     */
    public function getItemChildHTML($item,$html){
        if(!empty($item["child_node"])){
            $html .='<a target="'.$item[NavMenu::URL_TARGET].'" class="dropdown-item" href="'.$item[NavMenu::URL].'">'.$item[NavMenu::TITLE].'</a>';
            foreach($item["child_node"] as $item_new){
                return $this->getItemChildHTML($item_new,$html);
            }
        }else{
            return $html .='<a target="'.$item[NavMenu::URL_TARGET].'" class="dropdown-item" href="'.$item[NavMenu::URL].'">'.$item[NavMenu::TITLE].'</a>';
        }
    }

    public function galleryPage(){
        $obj = new GalleryItem();
        $getAllGalleryImages = $obj->getAllGalleryImages();
        $getAllVideos = $obj->getAllGalleryVideos();
        return view("HomePage.galleryPage",compact("getAllGalleryImages","getAllVideos"));
    }

    public function refreshCapthca(){
        try{
            $return = ["status"=>true,"message"=>"Success","data"=>Captcha::src()];

        }catch(Exception $exception){
            $return = ["status"=>false,"message"=>$exception->getMessage(),"data"=>$exception->getTraceAsString()];
        }
        return response()->json($return);
    }
}
