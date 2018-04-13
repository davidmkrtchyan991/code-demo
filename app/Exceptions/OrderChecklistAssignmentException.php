<?php

namespace App\Exceptions;


class OrderChecklistAssignmentException extends \Exception
{
    public function __toString()
    {
        return "Checklist assignment failed";
    }
}