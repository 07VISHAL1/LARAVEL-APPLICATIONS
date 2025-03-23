<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Log;
use SalaryService;

class SalaryController extends Controller
{
    
	/** 
	* returning salary table file located in the views to show salary data of the employee
	* @return \Illuminate\Http\view 
	*/
    public function salaryTable()
    {  
        try
        {
            return view('SalaryTable');
        }
        catch(Exception $e) 
        {
         Log::error('Exception encountered in SalaryController->salaryTable : ' . $e);
         return redirect()->back()->with('Exception','view file cannot be loaded due to exception. Please try again.', [], 500);
        }
    }

	/** 
	*  fetching data for the datatables and displaying the data of the salary 
	*  @param Request $request
    *  @return \Illuminate\Http\Response
	*/
    public function getSalaryData(Request $request) 
    {
        try
        {
            $response = SalaryService::salaryTable($request);
            return response()->json($response);
        }
        catch (Exception $e)
        {
            Log::error('Exception encountered  in SalaryController->getSalaryData  ' . $e);
            return response()->json(['error' => 'Please try again.'], 500);
        }
    }
    /** 
	*  editing the salary of the employee
	*  @param Request $request
    *  @return \Illuminate\Http\Response
	*/
    public function editSalary(Request $request) 
    {
        try
        {
            $id= $request->id;
            
            $response = SalaryService::edit($id);
            return view('auth.editSalary',compact('response'));
            
        }
        catch (Exception $e)
        {
            Log::error('Exception encountered  in SalaryController->getSalaryData  ' . $e);
            return response()->json(['error' => 'Please try again.'], 500);
        }
    }
    /** 
	*  after editing and saving the salary of the employee
	*  @param Request $request
    *  @return \Illuminate\Http\Response
	*/
    public function saveSalary(Request $request) 
    {
        try
        {
            $validate =validator::make($request->all(),[
                'employee_id'   => ['required', 'string', 'max:255'],
                'year'          => ['required','string', 'max:255'],
                'amount'        => ['required','string', 'max:255'],
            ]);
            if($validate->fails())
                return redirect()->back()->with('errors',$validate->errors());
            $employee = SalaryService::save($request);
            if($employee == true)
                return redirect()->back()->with('success', 'updated succesfully');
            elseif($employee==false)
                return redirect()->back()->with('error', 'Employee could not be updted!');
            else
                return redirect()->back()->with('error','Employee could not be updted to exception. Please try again.');
        }
        catch (Exception $e)
        {
            Log::error('Exception encountered  in SalaryController->getSalaryData  ' . $e);
            return response()->json(['error' => 'Please try again.'], 500);
        }
    }
}