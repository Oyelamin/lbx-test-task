<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeFromImportRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Imports\EmployeeListImport;
use App\Models\Employee;
use App\Support\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeManagementsController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        $this->resourceItem       = EmployeeResource::class;
        $this->resourceCollection = EmployeeCollection::class;
    }


    /**
     * @return mixed
     */
    public function index(): mixed
    {
        $limit = request('limit') ?? 20;
        $collection = Employee::orderBy('id', 'desc')->paginate($limit);
        return $this->respondWithCollection($collection);
    }


    /**
     * -------------------------------------------
     * Create Employee from file upload
     * ---------------------------------
     * @param CreateEmployeeFromImportRequest $request
     * @return JsonResponse
     */
    public function createFromImport(CreateEmployeeFromImportRequest $request): JsonResponse
    {
        $message = __("Something went wrong while uploading lists. Please try recheck the structure of the file and try again later.");
        try{
            $status = Response::HTTP_BAD_REQUEST;
            $file = $request->file('file');

            if ($file) {
                Excel::queueImport(new EmployeeListImport(), $file->store('temp')); // Import and process data

                $message =  __("Employee list has been uploaded successfully.");
                $status = Response::HTTP_OK;
            }

            return $this->respondWithCustomData(message: $message, status: $status);

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return $this->respondWithCustomData(message: $message, status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee): JsonResponse
    {
        return $this->respondWithCustomData(data: new $this->resourceItem($employee));
    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function delete(Employee $employee): JsonResponse
    {
        $employee->delete();
        return $this->respondWithCustomData(message: "Employee has been deleted successfully.");
    }

}
