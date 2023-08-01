<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
  public function edit(Request $request, $id)
  {
      //remove support from unread messages
      $slug = $this->getSlug($request);
      if($slug=='supports'){
        auth()->user()->unreadsupport()->detach($id);
      }
      return parent::edit($request, $id);
  }
}
