<?php

require_once("models/profile_model.php");

$profileModel = new ProfileModel();
$profileModel->name = "Ignacio";
$profileModel->lastName = "Quinteros";
$profileModel->location = "Mi casa";
$profileModel->rut = 123123;
$profileModel->number = 9584372;

$listaProfiles = array();
$listaProfiles["profile1"] = $profileModel->toArray();
array_push($listaProfiles, $profileModel->toArray());
array_push($listaProfiles, $profileModel->toArray());
array_push($listaProfiles, $profileModel->toArray());

echo json_encode($listaProfiles);