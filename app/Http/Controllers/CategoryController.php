<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryFormInsertRequest;
use App\Models\CategoryDetails;
use App\Models\CategoryPersonMap;
use App\Models\PersonDetails;
use App\Models\WardDetails;
use Illuminate\Http\Request;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('dashboard.create-category.create-category-form');
    }

    public function insertCategoryDetails(CategoryCreateRequest $request)
    {
        //dd( $request);
        $logUserId = auth()->user()->id;

        $date = Carbon::now(new DateTimeZone('Asia/Colombo'));
        $dateAndTime = $date->toDateTimeString();

        $CategoryRecodeDetails = CategoryDetails::create(
            [
                'fldCategoryType' => $request['categoryType'],
                'fldCreatedDate' => $dateAndTime,
                'fldCreatedBy' => $logUserId,
            ]
        );

        return back()->with('message', 'Category Create successfully.');
    }

    public function viewCategoryList()
    {
        $categoryList = DB::table('tblCategory')
            ->leftJoin('tblCategoryPersonMap', 'tblCategory.id', '=', 'tblCategoryPersonMap.fldIdCategory')
            ->select('tblCategory.id', DB::raw('count(tblCategoryPersonMap.fldIdCategory) AS membercount'), 'tblCategory.fldCategoryType', 'tblCategory.fldCreatedDate')
            ->groupBy('tblCategory.id', 'tblCategory.fldCategoryType', 'tblCategory.fldCreatedDate')
            ->orderBy('fldCreatedDate', 'DESC')
            ->paginate(10);

        return view('dashboard.view-category.view-category-list')->with(
            [
                'categoryList' => $categoryList
            ]
        );
    }

    public function viewCategoryPersonDetailInsertForm($id)
    {
        $wardListToDropDown = WardDetails::all();
        $allPersonDetails = DB::select("SELECT tblDetailPerson.*,tblWard.fldWardName AS wardName FROM `tblDetailPerson` Join tblWard On tblWard.id = tblDetailPerson.fldIdWard");

        return view('dashboard.view-category.add-person-category-form')->with(
            [
                'wardListToDropDown' => $wardListToDropDown,
                'categoryId' => $id,
                'personDetailsByCategory' => $allPersonDetails,
            ]
        );
    }

    // public function action(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //   $output = '';
    //   $query = $request->get('query');
    //   if($query != '')
    //   {
    //    $data = DB::table('tblDetailPerson')
    //      ->where('fldTelephoneNo', 'like', ''.$query.'%')
    //      ->get();
         
    //   }
    //   else
    //   {
    //    $data = DB::table('tblDetailPerson')
    //      ->orderBy('id', 'desc')
    //      ->get();
    //   }
    //   $total_row = $data->count();
    //   if($total_row > 0)
    //   {
    //    foreach($data as $row)
    //    {
    //     $url = $_SERVER['HTTP_REFERER'];
    //     $category = substr($url, strrpos($url, '/') + 1);
    //     $output .= '
    //     <tr>
    //      <td>
    //         <p class="text-xs mb-0" style="font-size:11px">'.$row->fldTelephoneNo.'</p>
    //         <p class="text-xs mb-0" style="font-size:11px">'.$row->fldFirstName.'&nbsp;'.$row->fldLastName.'</p>
    //         <p class="text-xs mb-0" style="font-size:11px">'.$row->fldAddLine1.', '.$row->fldAddLine2.'&nbsp;,&nbsp;'.$row->fldAddLine3.'&nbsp;,&nbsp;'.$row->fldAddLine4.'</p>
    //      </td>
    //      <td style="width:20px">
    //             <input name="user_id" type="text" hidden  value="'.$row->id.'">
    //             <input name="categoty_id" id="categoty_id" type="text" hidden value="'.$category.'">
    //             <button class="btn btn-primary" type="submit">Save</button>
    //     </td>
    //     </tr>
    //     ';
    //    }
    //   }
    //   else
    //   {
    //    $output = '
    //    <tr>
    //     <td align="center" colspan="5">No Data Found</td>
    //    </tr>
    //    ';
    //   }
    //   $data = array(
    //    'table_data'  => $output,
    //    'total_data'  => $total_row
    //   );

    //   echo json_encode($data);
    //  }
    // }

    // public function existingUserCreate($categoryId, $id)
    // {
    //     $userId = $id;
    //     $categoty_id= $categoryId;
        
    //     $checkUserExisting = DB::select("SELECT * FROM tblCategoryPersonMap WHERE fldIdPersonDetail = $userId AND fldIdCategory =  $categoty_id");
    //     if($checkUserExisting != null)
    //     {
    //         return back()->with('error', 'This User Already Existing.');
    //     }
    //     else
    //     {
    //         $date = Carbon::now(new DateTimeZone('Asia/Colombo'));
    //         $dateAndTime = $date->toDateTimeString();

    //         $logUserId = auth()->user()->id;

    //         $CategoryPersonDetailMapDetails = CategoryPersonMap::create(
    //             [
    //                 'fldIdPersonDetail' => $userId,
    //                 'fldIdCategory' => $categoty_id,
    //                 'fldDateCreated' => $dateAndTime,
    //                 'fldCreatedBy' => $logUserId,
    //             ]
    //         );

    //         return back()->with('message', 'Recode Create successfully.');
    //     }        
            
    // }

    public function fetchData($telephone_no) {
        $data = DB::table('tblDetailPerson')
         ->where('fldTelephoneNo', $telephone_no)
         ->first();
        return response()->json($data);
      }


    public function insertPersonDetails(CategoryFormInsertRequest $request)
    {

        $categoty_id = $request['categoty_id'];
        $telephone_no = $request['telephone_no'];
        $data = PersonDetails::where("fldTelephoneNo", $telephone_no)->first();
        if($data  != null)
        {
            $userId = $data['id'];
            $checkUserExisting = DB::select("SELECT * FROM tblCategoryPersonMap WHERE fldIdPersonDetail = $userId AND fldIdCategory =  $categoty_id");
            if($checkUserExisting != null)
            {
                return back()->with('error', 'This User Already Existing.');
            }
            else
            {
                $date = Carbon::now(new DateTimeZone('Asia/Colombo'));
                $dateAndTime = $date->toDateTimeString();

                $logUserId = auth()->user()->id;

                $CategoryPersonDetailMapDetails = CategoryPersonMap::create(
                    [
                        'fldIdPersonDetail' => $userId,
                        'fldIdCategory' => $categoty_id,
                        'fldDateCreated' => $dateAndTime,
                        'fldCreatedBy' => $logUserId,
                    ]
                );

                return back()->with('message', 'Recode Create successfully.');
                
            }  
        }
        else
        {
            if ($request['ward_id'] == '1') {
                return back()->with('error', 'Ward is Required.');
            } else {
                $logUserId = auth()->user()->id;
    
                $lastSortOrder = DB::table('tblDetailPerson')
                    ->orderBy('sort_order', 'desc')
                    ->value('sort_order');

                $sortOrder = is_null($lastSortOrder) ? 1 : $lastSortOrder + 1;

                $date = Carbon::now(new DateTimeZone('Asia/Colombo'));
                $dateAndTime = $date->toDateTimeString();
                $fldDeleteStatus = 1;
                $PersonDetailRecode = PersonDetails::create(
                    [
                        'fldFirstName' => $request['first_name'],
                        'fldLastName' => $request['last_name'],
                        'fldAddLine1' => $request['add_line_1'],
                        'fldAddLine2' => $request['add_line_2'],
                        'fldAddLine3' => $request['add_line_3'],
                        'fldAddLine4' => $request['add_line_4'],
                        'fldNicNo' => $request['nic_no'],
                        'fldDob' => $request['dob'],
                        'fldTelephoneNo' => $request['telephone_no'],
                        'fldIdWard' => $request['ward_id'],
                        'fldCreatedDate' => $dateAndTime,
                        'fldCreatedBy' => $logUserId,
                        'fldEmail' => $request['email'],
                        'fldFirstAdditionalData' => $request['additional_data_1'],
                        'fldSecondAdditionalData' => $request['additional_data_2'],
                        'fldThirdAdditionalData' => $request['additional_data_3'],
                        'fldFourthAdditionalData' => $request['additional_data_4'],
                        'fldFifthAdditionalData' => $request['additional_data_5'],
                        'fldsixthAdditionalData' => $request['additional_data_6'],
                        'fldseventhAdditionalData' => $request['additional_data_7'],
                        'fldEighthAdditionalData' => $request['additional_data_8'],
                        'fldNinthAdditionalData' => $request['additional_data_9'],
                        'fldTenthAdditionalData' => $request['additional_data_10'],
                        'fldFirstAdditionalField' => $request['additional_field_1'],
                        'fldSecondAdditionalField' => $request['additional_field_2'],
                        'fldThirdAdditionalField' => $request['additional_field_3'],
                        'fldFourthAdditionalField' => $request['additional_field_4'],
                        'fldFifthAdditionalField' => $request['additional_field_5'],
                        'fldsixthAdditionalField' => $request['additional_field_6'],
                        'fldseventhAdditionalField' => $request['additional_field_7'],
                        'fldEighthAdditionalField' => $request['additional_field_8'],
                        'fldNinthAdditionalField' => $request['additional_field_9'],
                        'fldTenthAdditionalField' => $request['additional_field_10'],
                        'fldDeleteStatus' => $fldDeleteStatus,
                        'sort_order' => $sortOrder ,
                    ]
                );
    
                $personId = $PersonDetailRecode->id;
    
                $CategoryPersonDetailMapDetails = CategoryPersonMap::create(
                    [
                        'fldIdPersonDetail' => $personId,
                        'fldIdCategory' => $request['categoty_id'],
                        'fldDateCreated' => $dateAndTime,
                        'fldCreatedBy' => $logUserId,
                    ]
                );
    
                return back()->with('message', 'Recode Create successfully.');
            }
        }          
    }

    public function viewElectorateByCategory($id)
    {

        $electorateList = DB::table('tblElectorate')
            ->rightJoin('tblCouncil', 'tblElectorate.id', '=', 'tblCouncil.fldIdElectorate')
            ->join('tblWard', 'tblCouncil.id', '=', 'tblWard.fldIdCouncil')
            ->rightJoin('tblDetailPerson', 'tblWard.id', '=', 'tblDetailPerson.fldIdWard')
            ->rightJoin('tblCategoryPersonMap', 'tblDetailPerson.id', '=', 'tblCategoryPersonMap.fldIdPersonDetail')
            ->where('tblCategoryPersonMap.fldIdCategory', $id)
            ->select('tblElectorate.id', 'tblElectorate.fldElectorateName', DB::raw('count(tblDetailPerson.id) AS membercount'))
            ->groupBy('tblElectorate.id', 'tblElectorate.fldElectorateName')
            ->paginate(10);

        return view('dashboard.view-category.view-electorate-category-dashboard')->with(
            [
                'electorateList' => $electorateList,
                'categoryId' => $id
            ]
        );
    }

    public function viewCouncilByCategory($categoryId, $id)
    {
        $councilList = DB::table('tblElectorate')
            ->rightJoin('tblCouncil', 'tblElectorate.id', '=', 'tblCouncil.fldIdElectorate')
            ->rightJoin('tblWard', 'tblCouncil.id', '=', 'tblWard.fldIdCouncil')
            ->rightJoin('tblDetailPerson', 'tblWard.id', '=', 'tblDetailPerson.fldIdWard')
            ->rightJoin('tblCategoryPersonMap', 'tblDetailPerson.id', '=', 'tblCategoryPersonMap.fldIdPersonDetail')
            ->where('tblCategoryPersonMap.fldIdCategory', $categoryId)
            ->where('tblElectorate.id', $id)
            ->select('tblCouncil.id', 'tblCouncil.fldCouncilName', DB::raw('count(tblDetailPerson.id) AS membercount'))
            ->groupBy('tblCouncil.id', 'tblCouncil.fldCouncilName')
            ->paginate(10);

        return view('dashboard.view-category.view-municipal-council-category-dashboard')->with(
            [
                'councilList' => $councilList,
                'categoryId' => $categoryId,
                'electorateID' => $id
            ]
        );
    }

    public function viewWardByCategory($categoryId, $id)
    {
        $wardList = DB::table('tblElectorate')
            ->rightJoin('tblCouncil', 'tblElectorate.id', '=', 'tblCouncil.fldIdElectorate')
            ->join('tblWard', 'tblCouncil.id', '=', 'tblWard.fldIdCouncil')
            ->rightJoin('tblDetailPerson', 'tblWard.id', '=', 'tblDetailPerson.fldIdWard')
            ->rightJoin('tblCategoryPersonMap', 'tblDetailPerson.id', '=', 'tblCategoryPersonMap.fldIdPersonDetail')
            ->where('tblCategoryPersonMap.fldIdCategory', $categoryId)
            ->select('tblWard.id', 'tblWard.fldWardName', DB::raw('count(tblDetailPerson.id) AS membercount'))
            ->groupBy('tblWard.id', 'tblWard.fldWardName')
            ->paginate(10);

        return view('dashboard.view-category.view-ward-category-dashboard')->with(
            [
                'wardList' => $wardList,
                'categoryId' => $categoryId,
                'councilId' => $id
            ]
        );
    }

    public function viewPersonDetailsByCategory($categoryId, $id)
    {
        $personDetailsByCategory = DB::table('tblElectorate')
            ->rightJoin('tblCouncil', 'tblElectorate.id', '=', 'tblCouncil.fldIdElectorate')
            ->rightJoin('tblWard', 'tblCouncil.id', '=', 'tblWard.fldIdCouncil')
            ->rightJoin('tblDetailPerson', 'tblWard.id', '=', 'tblDetailPerson.fldIdWard')
            ->rightJoin('tblCategoryPersonMap', 'tblDetailPerson.id', '=', 'tblCategoryPersonMap.fldIdPersonDetail')
            ->where('tblCategoryPersonMap.fldIdCategory', $categoryId)
            ->where('tblWard.id', $id)
            ->select('tblDetailPerson.*','tblCategoryPersonMap.delete_status')
            ->paginate(20);

        return view('dashboard.view-category.view-member-details-category')->with(
            [
                'personDetailsByCategory' => $personDetailsByCategory,
                'categoryId' => $categoryId,
                'wardID' => $id,
            ]
        );
    }

    public function removeCategoryList()
    {
        $allCategories = DB::select("SELECT * FROM tblCategory ORDER BY id DESC");
        return view('dashboard.settings.category-delete')->with([
            'categoryList' => $allCategories,
        ]);
    }

    public function deleteCategory($id)
    {

        $memberCounts = DB::select("SELECT * FROM tblCategoryPersonMap WHERE fldIdCategory = $id");

        if($memberCounts == null)
        {
            DB::table('tblCategory')->where('id', $id)->delete();
            $allCategories = DB::select("SELECT * FROM tblCategory ORDER BY id DESC");
            // return view('dashboard.settings.category-delete')->with([
            //     'categoryList' => $allCategories,
            // ]);

            return back()->with('message', 'Category delete successfully.');
        }
        else
        {
            return back()->with('error', 'You can not delete this category please contact Admin.');
        }
    }

    public function downloadCategoryMembers($id)
    {

        $stringOutput = "REGId,MEMBER NAME,PHONE NUMBER,WARD NAME,ADDRESS,NIC,DOB";
        $stringOutput .= "\n";

        $allPersonDetails = DB::select("SELECT tblDetailPerson.*,tblWard.fldWardName AS wardName, tblCategory.fldCategoryType AS categoryName FROM `tblDetailPerson` 
                                        Join tblWard On tblWard.id = tblDetailPerson.fldIdWard
                                        join tblCategoryPersonMap on tblCategoryPersonMap.fldIdPersonDetail = tblDetailPerson.id
                                        join tblCategory on tblCategory.id = tblCategoryPersonMap.fldIdCategory
                                        where tblCategoryPersonMap.fldIdCategory = $id");


        foreach($allPersonDetails as $idea)
        {
            $stringOutput .="\"REG".$idea->id."\",\"".$idea->fldFirstName.$idea->fldLastName."\",\"".$idea->fldTelephoneNo."\",\"".$idea->wardName."\",\"".$idea->fldAddLine1.$idea->fldAddLine2.$idea->fldAddLine3.$idea->fldAddLine4."\",\"".$idea->fldNicNo."\",\"".$idea->fldDob."\"";
            $stringOutput .= "\n";
        }

        header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=electorate-person-details-".$idea->categoryName.".csv");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $stringOutput;
            die;

    }

    public function editCategoryDetails($id)
    {
        $getCategoryDetail = CategoryDetails::where('id', $id)->first();

        return view('dashboard.create-category.edit-category-form')->with(
            [
                'getCategoryDetail' => $getCategoryDetail,
            ]
        );
    }

    public function categoryDetailUpdate(CategoryCreateRequest $request)
    {
        $categoryDetails = DB::select("SELECT * FROM tblCategory WHERE id = '$request->CategoryId'");

        $id = $request->CategoryId;
        CategoryDetails::find($id)->update(
            [
                'fldCategoryType' => $request['categoryType'],
            ]);

        return back()->with('message', 'Category Update successfully.');
    }

}
