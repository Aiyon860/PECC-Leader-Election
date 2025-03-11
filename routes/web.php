<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
})->name("login")->middleware("guest");

Route::get("/dashboard", function () {
  return view("admin.dashboard");
})->middleware("auth");

Route::get("/result", function () {
  return view("admin.result");
})->middleware("auth");

Route::get("/candidates", function () {
  return view("admin.candidates.display-candidates");
})->middleware("auth");

Route::get("/candidates/add-candidate", function () {
  return view("admin.candidates.add-edit-candidate-form");
})->middleware("auth");

Route::get("/candidates/edit-candidate", function () {
  return view("admin.candidates.add-edit-candidate-form");
})->middleware("auth");

Route::get("/voters", function () {
  return view("admin.voters.display-voters");
})->middleware("auth");

Route::get("/voters/add-voter", function () {
  return view("admin.voters.add-voter-form");
})->middleware("auth");

Route::get("/voters/import-voters", function () {
  return view("admin.voters.import-voters");
})->middleware("auth");

Route::get("/voters/remove-voters", function () {
  return view("admin.voters.remove-voters");
})->middleware("auth");

Route::get("/vote", function () {
  return view("user.vote");
})->middleware("auth");

Route::get("/thank-you", function () {
  return view("user.thank-you");
})->middleware("auth");

Route::middleware("auth")->group(function () {
  Route::get("/dashboard");
  Route::get("/result");
  Route::get("/candidates");
  Route::get("/candidates/add-candidate");
  Route::get("/candidates/edit-candidate");
  Route::get("/voters");
  Route::get("/voters/add-voter");
  Route::get("/voters/import-voters");
  Route::get("/voters/remove-voters");
  Route::get("/vote");
  Route::get("/thank-you");
});