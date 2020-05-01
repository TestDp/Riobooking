<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 2/01/2019
 * Time: 5:21 PM
 */

namespace App\Org_Saludables\Negocio\DTO;


abstract class BaseDTO
{
    /**
     * BaseDTO constructor.
     */
    public function __construct()
    {
        //obtengo un array con los parámetros enviados a la función
        $params = func_get_args();
        //saco el número de parámetros que estoy recibiendo
        $num_params = func_num_args();
        if($num_params > 0) {
            $this->setArguments($params[0]);
        }
    }

    /**
     * @param $modelName
     * @return mixed
     */
    public function toModel($modelName){
        $model = new $modelName;
        $attrs = $model->getFillable();
        foreach ($attrs as $attr) {
            $model->{$attr} = $this->{$attr};
        }
        return $model;
    }

    /**
     * @param array $args
     */
    public function setArguments(array $args) {
        foreach ($args as $index => $arg) {
            if(property_exists($this, $index))
                $this->$index = $arg;
        }
    }

    public function __call($method, $params) {
        $var = substr($method, 3);
        if (strncasecmp($method, "get", 3) == 0) {
            return $this->$var;
        }
        if (strncasecmp($method, "set", 3) == 0) {
            $this->$var = $params[0];
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function toCollect() {
        return collect(get_object_vars($this));
    }

    /**
     * @return array
     */
    public function toArray() {
        return get_object_vars($this);
    }
}