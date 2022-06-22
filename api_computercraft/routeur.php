<?php

require_once('config/yml.class.php');
require_once('base.php');
require_once('controleur.php');
require_once('vue.php');

$configLecture = new Lire('config/config.yml');
$_Serveur_ = $configLecture->GetTableau();

$base = new base($_Serveur_['DataBase']);
$bdd = $base->getConnection();


if (isset($_GET['action']))
{
    $action = (string) htmlspecialchars($_GET['action']); // action a effectuer
    switch ($action)
    {
        case "create_user":
            if (isset($_GET['player']) && isset($_GET['mdp']) && isset($_GET['mail']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $mail = (string) htmlspecialchars($_GET['mail']);
                $result = create_user($bdd,$player,$mdp,$mail);
                print_message($result,$_Serveur_['message_error'][$result]);
                printlog($bdd,0,$action,$result,$player . "-" . $mail);
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player . "-" . $mail);
            }
			break;
        case "connect_user": // (api et no api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $api_access = (bool) htmlspecialchars($_GET['api_access']);
                $session = connect_user($bdd,$player,$mdp,$api_access);
                if ($session["login"])
                {
                    print_array("session",$session);
                    printlog($bdd,$session["id"],$action,"0",$player . "-" . $api_access);
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
			break;
        case "update_user":
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $session = connect_user($bdd,$player,$mdp,false);
                if ($session["login"])
                {
                    $new_mdp = (string) htmlspecialchars($_GET['new_mdp']);
                    $new_mail = (string) htmlspecialchars($_GET['mail']);
                    $result = update_user($bdd,$session,$new_mdp,$new_mail);
                    print_message($result,$_Serveur_['message_error'][$result]);
                    printlog($bdd,$session["id"],$action,$result,$player);
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
			break;
        case "list_offre":
            $player = (string) htmlspecialchars($_GET['player']);
            $type = (string) htmlspecialchars($_GET['type']);
            $livraison = (string) htmlspecialchars($_GET['livraison']);
            $nom = (string) htmlspecialchars($_GET['nom']);
            $l_offre = list_offre($bdd,$player,$type,$livraison,$nom);
            print_offre_value($l_offre);
			break;
        case "update_offre": // (connect_user) (api et no api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
				$player = (string) htmlspecialchars($_GET['player']);
				$mdp = (string) htmlspecialchars($_GET['mdp']);
                $api_access = (bool) htmlspecialchars($_GET['api_access']);
				$session = connect_user($bdd,$player,$mdp,$api_access);
				if ($session["login"])
				{
					$id = (int) htmlspecialchars($_GET['id']);
					$prix = (float) htmlspecialchars($_GET['prix']);
					$nbr_dispo = (int) htmlspecialchars($_GET['nbr_dispo']);
					$type = (string) htmlspecialchars($_GET['type']);
					$livraison = (string) htmlspecialchars($_GET['livraison']);
					$nom = (string) htmlspecialchars($_GET['nom']);
					$description = (string) htmlspecialchars($_GET['description']);
					$statuts = (string) htmlspecialchars($_GET['statuts']);
					$result = update_offre($bdd,$session,$id,$prix,$nbr_dispo,$type,$livraison,$nom,$description,$statuts);
                    print_message($result,$_Serveur_['message_error'][$result]);
                    printlog($bdd,$session["id"],$action,$result,$player ."-id:". $id ."-prix:". $prix ."-nbr:". $nbr_dispo ."-type:". $type ."-livr:". $livraison ."-nom:". $nom ."-desc:". $description ."-stat:". $statuts);
				}
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
			}
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
			break;
        case "achat": // (connect_user)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $api_access = (bool) htmlspecialchars($_GET['api_access']);
                $session = connect_user($bdd,$player,$mdp,$api_access);
                if ($session["login"])
                {
                    if (isset($_GET['quantite']) && isset($_GET['ref_commande']))
                    {
                        $quantite = (string) htmlspecialchars($_GET['quantite']);
                        $ref_commande = (string) htmlspecialchars($_GET['ref_commande']);
                        $result = achat($bdd,$session,$ref_commande,$quantite);
                        print_message($result,$_Serveur_['message_error'][$result]);
                        printlog($bdd,$session["id"],$action,$result,$player ."-ref:". $ref_commande ."-quant:". $quantite);
                    }
                    else
                    {
                        print_message("4",$_Serveur_['message_error']['4']);
                        printlog($bdd,$session["id"],$action,"4",$player);
                    }
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
			break;
        case "list_commande": // (connect_user) (api et no api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $api_access = (bool) htmlspecialchars($_GET['api_access']);
                $session = connect_user($bdd,$player,$mdp,$api_access);
                if ($session["login"])
                {
                    $l_commande = list_commande($bdd,$session);
                    print_commande_value($l_commande);
                    printlog($bdd,$session["id"],$action,"0",$player);
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
            break;
        case "edit_commande_statuts_commerce": // (connect_user) (api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $session = connect_user($bdd,$player,$mdp,true);
                if ($session["login"])
                {
                    if (isset($_GET['id']) && isset($_GET['statuts']))
                    {
                        $statuts = (string) htmlspecialchars($_GET['statuts']);
                        $id = (string) htmlspecialchars($_GET['id']);
                        $result = edit_commande_statuts_commerce($bdd,$session,$id,$statuts);
                        print_message($result,$_Serveur_['message_error'][$result]);
                        printlog($bdd,$session["id"],$action,$result,$player ."-id:". $id ."-stat:". $statuts);
                    }
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
            break;
        case "transaction": // (connect_db) (api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $session = connect_user($bdd,$player,$mdp,true);
                if ($session["login"])
                {
                    if ($session["role"] == $nom_role_banque)
                    {
                        if (isset($_GET['recepteur']) && isset($_GET['somme']) && isset($_GET['type']) && isset($_GET['description']) && isset($_GET['expediteur']) && isset($_GET['ref_commande']))
                        {
                            $recepteur = (string) htmlspecialchars($_GET['recepteur']);
                            $somme = (string) htmlspecialchars($_GET['somme']);
                            $type = (string) htmlspecialchars($_GET['type']);
                            $description = (string) htmlspecialchars($_GET['description']);

                            $expediteur = (string) htmlspecialchars($_GET['expediteur']);
                            $ref_commande = (string) htmlspecialchars($_GET['ref_commande']);
                            $result = transaction($bdd,$somme,$type,$description,$recepteur,$expediteur,$ref_commande);
                            print_message($result,$_Serveur_['message_error'][$result]);
                            printlog($bdd,$session["id"],$action,$result,$player ."-recep:". $recepteur ."-somme:". $somme ."-type:". $type ."-desc:". $description ."-expe:". $expediteur ."-ref:". $ref_commande);        
                        }
                        else
                        {
                            print_message("4",$_Serveur_['message_error']['4']);
                            printlog($bdd,$session["id"],$action,"4",$player);
                        }
                    }
                    else
                    {
                        print_message("2",$_Serveur_['message_error']['2']);
                        printlog($bdd,$session["id"],$action,"2",$player);
                    }
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
			break;
        case "list_transaction": // (connect_user)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $session = connect_user($bdd,$player,$mdp);
                if ($session["login"])
                {
                    $l_transaction = list_transaction($bdd,$session);
                    print_transaction_value($l_transaction);
                    printlog($bdd,$session["id"],$action,"0",$player);
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
			break;
        case "sync_jeton": // (connect_db) (api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $session = connect_user($bdd,$player,$mdp,true);
                if ($session["login"])
                {
                    if ($session["role"] == $nom_role_banque)
                    {
                        $jeton1 = (string) htmlspecialchars($_GET['jeton1']);
                        $jeton10 = (string) htmlspecialchars($_GET['jeton10']);
                        $jeton100 = (string) htmlspecialchars($_GET['jeton100']);
                        $jeton1k = (string) htmlspecialchars($_GET['jeton1k']);
                        $jeton10k = (string) htmlspecialchars($_GET['jeton10k']);
                        $result = sync_jeton($bdd,$session,$jeton1,$jeton10,$jeton100,$jeton1k,$jeton10k);
                        print_message($result,$_Serveur_['message_error'][$result]);
                        printlog($bdd,$session["id"],$action,$result,$player . "-j1:" . $jeton1 . "-j10:" . $jeton10 . "-j100:" . $jeton100 . "-j1k:" . $jeton1k . "-j10k:" . $jeton10k);
                    }
                    else
                    {
                        print_message("2",$_Serveur_['message_error']['2']);
                        printlog($bdd,$session["id"],$action,"2",$player);
                    }
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
            break;
        case "init_jeton": // (connect_db) (api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $session = connect_user($bdd,$player,$mdp,true);
                if ($session["login"])
                {
                    if ($session["role"] == $nom_role_banque)
                    {
                        $jeton1 = (string) htmlspecialchars($_GET['jeton1']);
                        $jeton10 = (string) htmlspecialchars($_GET['jeton10']);
                        $jeton100 = (string) htmlspecialchars($_GET['jeton100']);
                        $jeton1k = (string) htmlspecialchars($_GET['jeton1k']);
                        $jeton10k = (string) htmlspecialchars($_GET['jeton10k']);
                        $result = init_jeton($bdd,$session,$jeton1,$jeton10,$jeton100,$jeton1k,$jeton10k);
                        print_message($result,$_Serveur_['message_error'][$result]);
                        printlog($bdd,$session["id"],$action,$result,$player . "-j1:" . $jeton1 . "-j10:" . $jeton10 . "-j100:" . $jeton100 . "-j1k:" . $jeton1k . "-j10k:" . $jeton10k);
                    }
                    else
                    {
                        print_message("2",$_Serveur_['message_error']['2']);
                        printlog($bdd,$session["id"],$action,"2",$player);
                    }
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
            break;
        case "time":
            print_time_value();
            break;
        case "get_config":
            print_array("config",$_Serveur_['General']);
            break;

        case "list_abo": // (connect_db) (api)
            print_time_value();
            break;
        case "list_client_abo": // (connect_db) (api)
            print_time_value();
            break;
        case "edit_abo": // (connect_db) (api)
            print_time_value();
            break;
        case "update_abo_client": // (connect_db) (api)
            print_time_value();
            break;
        case "banque_traitement_transaction_commerce": // (connect_db) (api)
            if (isset($_GET['player']) && isset($_GET['mdp']))
            {
                $player = (string) htmlspecialchars($_GET['player']);
                $mdp = (string) htmlspecialchars($_GET['mdp']);
                $session = connect_user($bdd,$player,$mdp,true);
                if ($session["login"])
                {
                    if ($session["role"] == $nom_role_banque)
                    {
                        $l_commande = list_commande($bdd,$session);
                        for ($i = 0; $i <= count($l_commande[0]); $i++)
                        {
                            if ($l_commande[13][$i] == $_Serveur_['statuts_echange'][2])
                            {
                                $result = banque_traitement_transaction_commerce($bdd,$l_commande[0][$i]);
                                print_message($result,$_Serveur_['message_error'][$result]);
                                printlog($bdd,$session["id"],$action,$result,$player ."-ref:". $l_commande[0][$i]);   
                            }
                        }
                    }
                    else
                    {
                        print_message("2",$_Serveur_['message_error']['2']);
                        printlog($bdd,$session["id"],$action,"2",$player);
                    }
                }
                else
                {
                    print_message("3",$_Serveur_['message_error']['3']);
                    printlog($bdd,0,$action,"3",$player);
                }
            }
            else
            {
                print_message("4",$_Serveur_['message_error']['4']);
                printlog($bdd,0,$action,"4",$player);
            }
			break;
        case "banque_traitement_transaction_abo_client": // (connect_db) (api)
            print_time_value();
            break;
    }
}