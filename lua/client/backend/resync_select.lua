function resync_select()
	global_select_section = {
		type = global_http_error_message["type"],
		livraison = global_http_error_message["livraison"],
		type_adresse = global_http_error_message["type_adresse"],
		motif_litige = global_http_error_message["motif_litige"],
		adresse={["0"]="nil"}
	}
	for j=1, #global_filtre_liste["adresse"] do
		table.insert(global_select_section["adresse"],global_filtre_liste["adresse"][j][1])
	end
end