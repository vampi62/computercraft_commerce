# api_installation_maintenance


## nom_action (exemple)
- param1	:(type) parametre obligatoire
- param2    :(type)(optionnel) parametre non obligatoire

http://0.0.0.0:80/api_computercraft/index.php?action=__nom_action__&__param1__=__param1_val__&__param2__=__param2_val__

return (json_format)<br/>

```lua
global_url = "0.0.0.0"
global_port = "80"
global_uri = "api_computercraft"
function http_get(action)
	local source_return, err = http.get("http://"..global_url..":"..global_port.."/"..global_uri.."/index.php?action="..action)
	local source_text = source_return.readAll()
	return textutils.unserialise(source_text)
end

action="getjoueurbypseudo&mdp=__mdp__&pseudo=__pseudo__" -- exemple d'action
list_ou_code_retour = http_get(action)
print(list_ou_code_retour.status_code())-- =200 si la commande a ete effectuer
print(list_ou_code_retour.message())
print(list_ou_code_retour.data())-- n'est retourner que si une action get.. est effectuer avec succes
```

# installation

http://__global_url__:__global_port__/__global_uri__/index.php?

- mdp			:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		:(string) le role de ce compte est d'administrer le serveur
- email			:(string) l'email doit etre valide

http://__global_url__:__global_port__/__global_uri__/index.php?action=install&mdp=__mdp__&pseudo=__pseudo__&email=__email__

un code 200 est retourner si l'installation a reussi

# maintenance / mise a jour

sauf indication il suffira de :
- ! avant faite une sauvegarde de la base de donnée et des fichiers php !
- remplacer les fichiers php par les nouveaux en prenant soin de ne pas ecraser le fichier config.yml (verifier qu'il n'y a pas de nouvelle variable a ajouter)
- executer un script sql en cas de changement dans la base de donnée.