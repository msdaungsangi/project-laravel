<?php
namespace App\Contracts\Services;
use Illuminate\Http\Request;

interface LoginServiceInterface{
  public function updatePassword(Request $request, array $password);
}
?>
