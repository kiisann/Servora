<?php
class ReviewController extends Controller{
    private $reviewModel;
    public function __construct() {
        $this->reviewModel = $this->model('Review');
    }

    public function index(){
        $reviews = $this->reviewModel->getAll();
        $data = ['reviews' => $reviews];
        $this->view('admin/review', $data);
    }
    public function delete($id){
        if (!$id) {
            header('Location: ' . BASE_URL . '/review');
            exit;
        }
        $this->reviewModel->delete($id);

        header('Location: ' . BASE_URL . '/review');
        exit;
    }
}