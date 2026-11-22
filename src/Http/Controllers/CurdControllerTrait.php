<?php

namespace Rainte\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Rainte\Laravel\Exceptions\Exception;
use Rainte\Laravel\Http\Requests\SearchRule;
use Rainte\Laravel\Http\Requests\SetRule;
use Rainte\Laravel\Rules\Rule;
use Rainte\Laravel\Services\CurdService;

trait CurdControllerTrait
{
    /**
     * @var \Rainte\Laravel\Models\Model 模型.
     */
    protected $model;
    /**
     * @var CurdService 服务.
     */
    protected $service = CurdService::class;
    /**
     * @var \Rainte\Laravel\Http\Requests\Request 设置验证规则.
     */
    protected $setRule = SetRule::class;
    /**
     * @var \Rainte\Laravel\Http\Requests\Request 搜索验证规则.
     */
    protected $searchRule = SearchRule::class;
    /**
     * @var array|string 字段.
     */
    protected $columns = '*';

    public function add(Request $request)
    {
        $input = $request->validate($this->addRules());

        return $this->instance()->add($input);
    }

    public function get(Request $request)
    {
        $input = $request->validate($this->getRules());

        return $this->instance()->get($input);
    }

    public function set(Request $request)
    {
        $input = $request->validate($this->setRules());

        $this->instance()->set($input);
    }

    public function del(Request $request)
    {
        $input = $request->validate($this->delRules());

        $ok = $this->instance()->del($input);
        $ok or Exception::fail();
    }

    public function search(Request $request)
    {
        $input = $request->validate($this->searchRules());

        return $this->instance()->search($input);
    }

    protected function instance(): CurdService
    {
        $instance = $this->service::fake()
            ->setColumns($this->columns);

        $this->model and $instance->setModel($this->model);

        return $instance;
    }

    protected function addRules(): array
    {
        return $this->setRule::allRules();
    }

    protected function getRules(): array
    {
        return Rule::id();
    }

    protected function setRules(): array
    {
        $id = Rule::id();
        $add = $this->addRules();

        return array_merge($id, $add);
    }

    protected function delRules(): array
    {
        return Rule::delete();
    }

    protected function searchRules(): array
    {
        return $this->searchRule::allRules();
    }
}
