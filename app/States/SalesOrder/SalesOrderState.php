<?php

declare(strict_types=1);

namespace App\States\SalesOrder;

use Spatie\ModelStates\State;
use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Progress;
use Spatie\ModelStates\StateConfig;
use App\States\SalesOrder\Completed;
use App\States\SalesOrder\Transitions\PendingtoCancel;
use App\States\SalesOrder\Transitions\PendingtoProgress;
use App\States\SalesOrder\Transitions\ProgresstoCompleted;

abstract class SalesOrderState extends State
{
    abstract public function label() : string;

    public static function config(): StateConfig
    {
        return parent::config()
                ->default(Pending::class)
                ->allowTransition(Pending::class, Progress::class, PendingtoProgress::class)
                ->allowTransition(Pending::class, Cancel::class, PendingtoCancel::class)
                ->allowTransition(Pending::class, Completed::class, ProgresstoCompleted::class);
    }
}