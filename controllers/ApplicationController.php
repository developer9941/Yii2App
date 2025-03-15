<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use app\models\Application;

class ApplicationController extends Controller
{
    public $enableCsrfValidation = false; // Disable CSRF for simplicity (Not recommended for production)

    /**
     * Create a new application record.
     */
    public function actionCreate()
    {
        

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Application();

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return [
                'success' => true,
                'message' => 'Application created successfully',
                'data' => $model,
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to create application',
            'errors' => $model->errors,
        ];
    }

    /**
     * Update an existing application record by ID.
     */
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = Application::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("Application not found.");
        }

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return [
                'success' => true,
                'message' => 'Application updated successfully',
                'data' => $model,
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to update application',
            'errors' => $model->errors,
        ];
    }
}
