<?php

    function getRole(){
        $rol = auth()->user()->rol;
        return $rol;
    }
