api http acces via GET


## nom_action (exemple)
- param1	:(type) parametre obligatoire
- param2    :(type)(optionnel) parametre non obligatoire

http://0.0.0.0:9081/api_computercraft/index.php?action=__nom_action__&__param1__=__param1_val__&__param2__=__param2_val__

return (json_format)<br/>

```lua
global_url = "0.0.0.0"
global_port = "9081"
global_uri = "api_computercraft"
function http_get(action)
	local source_return, err = http.get("http://"..global_url..":"..global_port.."/"..global_uri.."/index.php?action="..action)
	local source_text = source_return.readAll()
	return textutils.unserialise(source_text)
end

action="listuserdata&mdp=__mdp__&pseudo=__pseudo__" -- exemple d'action
list_ou_code_retour = http_get(action)
print(list_ou_code_retour.status_code())-- =200 si la commande a ete effectuer
print(list_ou_code_retour.message())
print(list_ou_code_retour.data())-- n'est retourner que si une action get.. est effectuer avec succes
```

# installation

http://ipserveur/api_computercraft/installation/index.php?

- mdp			:(string) le mot de passe doit faire : plus de 8 caractère - une maj et une minuscule et un chiffre
- pseudo		:(string) le role de ce compte est d'administer le site via le panel admin (voir section en bas de cette page)
- mdpconfirm	:(string) doit être identique à __mdp__
- email			:(string) l'email doit etre valide

http://0.0.0.0:9081/api_computercraft/index.php?action=install&mdp=__mdp__&pseudo=__pseudo__&mdpconfirm=__mdpconfirm__&email=__email__

return (string)

# fonctionnement

http://ipserveur/api_computercraft/index.php?


## listntp

http://0.0.0.0:9081/api_computercraft/index.php?action=listntp

return (array)

## listconfig

http://0.0.0.0:9081/api_computercraft/index.php?action=listconfig

return (array)