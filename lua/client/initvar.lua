if not fs.exists(global_config_http) then
	files = fs.open(global_config_http, "w")
	files.writeLine("--[[ completer l'url avec vos informations ]]--")
	files.writeLine("global_url = '__ip__or__domain__'")
	files.writeLine("global_port = '80'")
	files.writeLine("global_api_uri = 'api_computercraft'")
	files.writeLine("global_lua_uri = 'lua'")
	files.writeLine("--[[ retirer le commentaire sur le type de poste a installer ]]--")
	files.writeLine("-- global_systeme_nom = 'client'")
	files.writeLine("-- global_systeme_nom = 'commerce'")
	files.writeLine("-- global_systeme_nom = 'banque_terminal'")
	files.writeLine("-- global_systeme_nom = 'banque_routeur'")
	files.writeLine("-- global_systeme_nom = 'banque_admin'")
	files.close()
	shell.run("edit " .. global_config_http)
	files = fs.open(global_config_http, "a")
	files.write("global_systeme_version = 'na'")
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
if not fs.exists(global_config_table_http) then
	files = fs.open(global_config_table_http, "w")
	files.writeLine("global_table_http = {}")
	files.writeLine("global_table_http['offre'] = {'id','adresse','proprio','prix','nbr_dispo','type','livraison','nom','description','dateupdate','nbr_commande'}")
	files.writeLine("global_table_http['commande_client'] = {'id','id_offre','id_transaction','nom_commande','expediteur','recepteur','text_adresse_expediteur','text_adresse_recepteur','quantite','somme','prix_unitaire','type','livraison','suivie','description','statut','date','heure'}")
	files.writeLine("global_table_http['commande_commerce'] = {'id','id_offre','id_transaction','nom_commande','expediteur','recepteur','text_adresse_expediteur','text_adresse_recepteur','quantite','somme','prix_unitaire','type','livraison','suivie','description','statut','date','heure'}")
	files.writeLine("global_table_http['transaction'] = {'id','id_commandes','id_admin_exec','crediteur','debiteur','somme','type','description','statut','date','heure'}")
	files.writeLine("global_table_http['adresse'] = {'nom','type','coo','description','nbr_offre'}")
	files.close()
end