<?php


namespace App\Controller;


use App\Models\Task;
use App\Models\User;

class PageController extends BaseController
{


    public function actionHome($page = 1)
    {
        $order_by = isset($_GET['order_by'])?$_GET['order_by']:'id';
        $order_by = in_array($order_by, ['id', 'name', 'completed', 'email'])?$order_by:'id';

        $order = isset($_GET['order'])?$_GET['order']:'DESC';
        $order = 'DESC' === strtoupper($order)?'DESC':'ASC';

        $page = (int)$page > 0?(int)$page:1;

        $this->login();
        $this->logout();
        $this->createTask();
        $this->updateTask();
        $this->deleteTask();

        $result = Task::getWithPagination($page, $order, $order_by);

        $this->view
            ->title('Task.me please')
            ->render('home', [
                'tasks' => $result['tasks'],
                'pagination' => $result['pagination'],
                'order' => $order,
                'order_by' => $order_by
            ]);
    }



    public function actionLogout()
    {
        middleware('auth', '/login');

        unset($_SESSION['user_id']);
        unset($_SESSION['logged_in']);

        redirect('/login');
    }

    public function actionError()
    {
        $this->view
            ->title('Page not found')
            ->layout('layout')
            ->render('404');
    }

    /**
     * Create task method
     */
    public function createTask()
    {
        if($_POST['create']){
            $name = $_POST['name']?:null;
            $email = $_POST['email']?:null;
            $description = $_POST['description']?:null;
            if($name && $email && $description){
                $result = Task::create($name, $email, $description);
                if($result){
                    $_REQUEST['success']['message'] = 'Task added successfully';
                }else{
                    $_REQUEST['error']['message'] = 'Something went wrong please try again';
                }

            }else{
                $_REQUEST['error']['message'] = 'Please fill fields';
            }
        }
    }

    public function updateTask()
    {
        if($_POST['update'] && is_admin()){
            $id = $_POST['id']?:null;
            $name = $_POST['name']?:null;
            $email = $_POST['email']?:null;
            $description = $_POST['description']?:null;
            $completed = $_POST['completed']?1:0;
            if($id && $name && $email && $description){
                $result = Task::update($id, $name, $email, $description, $completed);
                if($result){
                    $_REQUEST['success']['message'] = 'Task updated successfully';
                }else{
                    $_REQUEST['error']['message'] = 'Something went wrong please try again';
                }
            }else{
                $_REQUEST['error']['message'] = 'Please fill fields';
            }
        }
    }
    public function deleteTask()
    {
        if($_POST['delete'] && is_admin()){
            $id = $_POST['id']?:null;
            if($id){
                $result = Task::delete($id);
                if($result){
                    $_REQUEST['success']['message'] = 'Task deleted successfully';
                }else{
                    $_REQUEST['error']['message'] = 'Something went wrong please try again';
                }
            }else{
                $_REQUEST['error']['message'] = 'Something went wrong please try again';
            }
        }
    }

    /**
     * Quick login method
     */
    public function login(){
        if($_POST['login_action']){
            $login = $_POST['login']?:null;
            $password = $_POST['password']?:null;
            if($login === 'admin' && $password === '123'){
                $_SESSION['logged_in'] = time();
            }
        }
    }

    /**
     * Quick logout method
     */
    public function logout(){
        if($_POST['logout']){
            unset($_SESSION['logged_in']);
        }
    }
}
