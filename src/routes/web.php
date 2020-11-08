<?php

use tkouleris\WebWordCounter\Http\Controllers\WebWordCounterController;

Route::get('webwordcounter',[WebWordCounterController::class,'index']);
