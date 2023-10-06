<?php
namespace App\Contracts\Dao;
use Illuminate\Http\Request;

interface LoginDaoInterface{
  public function updatePassword(Request $request, array $password);
}
?>
