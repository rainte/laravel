<?php

namespace Rainte\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;

class DBBuilderServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function boot()
    {
        $this->addSoftDeleteWhere();
        $this->addDomainWhere();
        $this->addScopesWhere();
        $this->getTableAlias();
    }

    protected function addSoftDeleteWhere()
    {
        Builder::macro('addSoftDeleteWhere', function (string $class): Builder {
            $table = $this->getTableAlias();

            $model = new $class;
            $field = $model->getDeletedAtColumn();
            $value = $model->deletedValue;

            return $this->where($table . '.' . $field, '<>', $value);
        });
    }

    protected function addDomainWhere()
    {
        Builder::macro('addDomainWhere', function (string $class): Builder {
            $table = $this->getTableAlias();

            $model = new $class;
            $field = $model->domainAt();
            $value = $model->domain();

            return $this->where($table . '.' . $field, $value);
        });
    }

    protected function addScopesWhere()
    {
        Builder::macro('addScopesWhere', function (string $class): Builder {
            return $this->addSoftDeleteWhere($class)
                ->addDomainWhere($class);
        });
    }

    protected function getTableAlias()
    {
        Builder::macro('getTableAlias', function (): string {
            if ($this instanceof \Illuminate\Database\Query\JoinClause) {
                $tables = explode(' ', $this->table);
            } else {
                $tables = explode(' ', $this->from);
            }

            return count($tables) > 1 ? end($tables) : reset($tables);
        });
    }
}
