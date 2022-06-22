<?php
function print_commande_value($list_commande)
{
    print_array("id",$list_commande[0]);
    print_array("id_offre",$list_commande[1]);
    print_array("id_transaction",$list_commande[2]);
    print_array("nom_commande",$list_commande[3]);
    print_array("expediteur",$list_commande[4]);
    print_array("recepteur",$list_commande[5]);
    print_array("quantite",$list_commande[6]);
    print_array("somme",$list_commande[7]);
    print_array("prix_unitaire",$list_commande[8]);
    print_array("type",$list_commande[9]);
    print_array("livraison",$list_commande[10]);
    print_array("suivie",$list_commande[11]);
    print_array("description",$list_commande[12]);
    print_array("statuts",$list_commande[13]);
}
function print_offre_value($list_offre)
{
    print_array("id",$list_offre[0]);
    print_array("proprio",$list_offre[1]);
    print_array("prix",$list_offre[2]);
    print_array("nbr_dispo",$list_offre[3]);
    print_array("type",$list_offre[4]);
    print_array("livraison",$list_offre[5]);
    print_array("nom",$list_offre[6]);
    print_array("description",$list_offre[7]);
}
function print_transaction_value($l_transaction)
{
    print_array("id",$l_transaction[0]);
    print_array("id_commandes",$l_transaction[1]);
    print_array("expediteur",$l_transaction[2]);
    print_array("recepteur",$l_transaction[3]);
    print_array("somme",$l_transaction[4]);
    print_array("type",$l_transaction[5]);
    print_array("description",$l_transaction[6]);
    print_array("statuts",$l_transaction[7]);
    print_array("date",$l_transaction[8]);
    print_array("heure",$l_transaction[9]);
}



function print_time_value()
{
    echo(date("i")).'<br />';//minute
    echo(date("h")).'<br />';//heure
    echo(date("A")).'<br />';//heure matin ou midi
    echo(date("d")).'<br />';//jour
    echo(date("m")).'<br />';//mois
}
function print_message($code_message,$message)
{
    echo $code_message . "<br />";
    echo $message . "<br />";
}
function print_array($nom_de_la_list,$list)
{
    foreach($list as $element)
    {
        echo "" . $element . "',";
    }
    echo "<br />";
}