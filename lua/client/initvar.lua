if not fs.exists(global_config_http) then
	files = fs.open(global_config_http, "w")
	files.writeLine("--[[ completer l'url avec vos informations ]]--")
	files.writeLine("global_url = '__ip__or__domain__'")
	files.writeLine("global_port = '80'")
	files.writeLine("global_api_uri = 'api_computercraft'")
	files.writeLine("global_lua_uri = 'lua'")
	files.writeLine("--[[ retirer le commentaire sur le type de poste a installer ]]--")
	files.writeLine("-- global_poste = 'client'")
	files.writeLine("-- global_poste = 'commerce'")
	files.writeLine("-- global_poste = 'banque_terminal'")
	files.writeLine("-- global_poste = 'banque_routeur'")
	files.writeLine("-- global_poste = 'banque_admin'")
	files.close()
end
if not fs.exists(global_config_session) then
	files = fs.open(global_config_session, "w")
	files.write("global_session = {pseudo='', mdp='', compte=0, email='', defautadresse={nom='',type='',coo='',description=''}, nbr_offre=0, role='', last_login=''}")
	files.close()
end
if not fs.exists(global_config_panier) then
	files = fs.open(global_config_panier, "w")
	files.write("global_panier = {}")
	files.close()
end


