<?php
namespace Modules\Carts\Src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Carts\Src\Repositories\CartsRepositoryInterface;
use Modules\Courses\Src\Repositories\CoursesRepositoryInterface;

class CartsController extends Controller {

    protected $coursesRepository;

    protected $cartsRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository, CartsRepositoryInterface $cartsRepository) {
        $this->coursesRepository    = $coursesRepository;
        $this->cartsRepository      = $cartsRepository;
    }
    public function index() {
        $pageTitle = 'Giỏ hàng';
        $pageName  = 'Giỏ hàng';

        $carts = $this->cartsRepository->getAllCarts();
        return view('carts::index', compact('pageTitle', 'pageName', 'carts'));
    }

    public function create($courseId, Request $request) {
        $course = $this->coursesRepository->find($courseId);
        if ($course) {
            $quantity = $request->quantity ? floor($request->quantity) : 1;
            $studentId = Auth::guard('students')->user()->id;
            $cartExist = $this->cartsRepository->checkCartExist($studentId, $courseId);

            if ($cartExist) {
                $quantity += $cartExist->quantity;
            }

            $data = [
                'course_id' => $courseId,
                'student_id' => $studentId,
                'price' => $course->sale_price == 0 ? $course->price : $course->sale_price,
                'quantity' => $quantity
            ];
            $result = $this->cartsRepository
                ->updateOrCreate(['course_id' => $data['course_id'],
                    'student_id' => $data['student_id']],
                    ['quantity'=> $data['quantity'], 'price' => $data['price']]);
            if($result) {
                return redirect()->route('carts.index')
                    ->with('msg', __('carts::messages.create.success'));
            } else {
                return back()->with('msg', __('carts::messages.create.fail'));

            }
        } else {
            return  abort(404);
        }



    }

    public function update(Request $request) {
        $cartId = $request->cartId;

        $cart = $this->cartsRepository->find($cartId);
        $priceCourse = $cart->course->sale_price == 0 ? $cart->course->price : $cart->course->sale_price;
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);

        }
        $quantity = $request->quantity;
//        $total = $request->total;


        if ($quantity <= 0) {
            return response()->json(['error' => 'Invalid quantity'], 400);
        }

        $price = $priceCourse * $quantity;
//        $total += $price;
        $data  = [
                'quantity' => $quantity,
                'price' => $price,
//                'total' => $total
            ];

        $result = $this->cartsRepository->update($cartId, $data);
        $data['price'] = money($data['price']) ;
//        $data['total'] = money($data['total']) ;

        if ($result) {
            return response()->json(['data' => $data]);
        }
        return response()->json(['error' => 'Update failed'], 500);


    }
    public function delete($cardId) {
        if ($cardId) {
            $this->cartsRepository->delete($cardId);
            return redirect()->route('carts.index')
                ->with('msg', __('carts::messages.delete.success'));
        }
        return back()->with('msg', __('carts::messages.delete.fail'));

    }
}
