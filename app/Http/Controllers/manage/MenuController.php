<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use App\Category;
class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('manage/menu.index')->with('menus',$menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('manage/menu.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //validating user inputs
        $request->validate(
            [
                'name'      => 'required|unique:menus|max:255',
                'price'     => 'required|numeric',
                'desc'      => 'required|max:1000',
                'category'  => 'exists:categories,id',
                // 'image'     => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]            
        );

        //$imageName by default is false
        $imageName = false;
        if($request->image){
            $imageName = date('dmYHis').uniqid().'.'.$request->image->extension();
        }
       
        //saving response 
        $menuobj = new Menu();
        $menuobj->name = $request->name;
        $menuobj->price = $request->price;
        $menuobj->description = $request->desc;
        $menuobj->image = $imageName == true ? $imageName : "NA";
        $menuobj->category_id = $request->category;

        //if data stored succesuly290320222321246243471c2d402
            if($menuobj->save()){
                // if $imageName true store image 
                $imageName && $request->image->move(public_path('menu_images'),$imageName);
                Session()->flash('status',"Menu is Added!");
            }else{
                Session()->flash('status',"Somrthing went wrong , please try again later!");
        }
        return(redirect('/manage/menu'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuItem = Menu::findorFail($id);
        $categories = Category::all();
        return view("manage/menu.create")->with('menuItem',$menuItem)->with('categories',$categories);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validating user inputs
        $request->validate(
            [
                'name'      => 'required|max:255',
                'price'     => 'required|numeric',
                'desc'      => 'required|max:1000',
                'category'  => 'exists:categories,id',
            ]            
        );

        //$imageName by default is false
        $imageName = false;
        if($request->image){
            $imageName = date('dmYHis').uniqid().'.'.$request->image->extension();
        }
    
        //saving response 
        $menuobj = Menu::findorFail($id);
        $menuobj->name = $request->name;
        $menuobj->price = $request->price;
        $menuobj->description = $request->desc;
        $oldImageName = $menuobj->image;
        $menuobj->image = $imageName == true ? $imageName : "";
        $menuobj->category_id = $request->category;

        //if data stored succesuly
            if($menuobj->save()){
                // if $imageName true store image 
                $imageName && $request->image->move(public_path('menu_images'),$imageName);
                // if alredy image value filled Then remove that image
                $oldImageName && unlink(public_path('menu_images/'.$oldImageName));
                Session()->flash('status',"Menu is Updated!");
            }else{
                Session()->flash('status',"Something went wrong , please try again later!");
        }
        return(redirect('/manage/menu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if($menu->image){
            unlink(public_path('menu_images').'/'.$menu->image);
        }
        $menu->delete();
        Session()->flash('status',"Menu is Deleted!");
        return(redirect('/manage/menu'));
    }
}
