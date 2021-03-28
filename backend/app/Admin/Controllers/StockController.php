<?php

namespace App\Admin\Controllers;

use App\Models\Stock;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StockController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Stock());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('detail', __('Detail'));
        $grid->column('fee', __('Fee'));
        $grid->column('imgpath', __('Imgpath'));
        $grid->column('inventory', __('Inventory'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Stock::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('detail', __('Detail'));
        $show->field('fee', __('Fee'));
        $show->field('imgpath', __('Imgpath'));
        $show->field('inventory', __('Inventory'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Stock());

        $form->text('name', __('Name'));
        $form->text('detail', __('Detail'));
        $form->number('fee', __('Fee'));
        $form->text('imgpath', __('Imgpath'));
        $form->number('inventory', __('Inventory'));

        return $form;
    }
}
