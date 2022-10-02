function resync_select()
	global_select_section = {
		type = {},
		livraison = {},
		type_adresse = {},
		motif_litige = {},
		adresse = {}
	}
	for k, v in pairs(global_http_error_message["type"]) do
		if global_http_error_message["type"][k] ~= nil then
			global_select_section["type"][k] = global_http_error_message["type"][k]
		end
	end
	for k, v in pairs(global_http_error_message["livraison"]) do
		if global_http_error_message["livraison"][k] ~= nil then
			global_select_section["livraison"][k] = global_http_error_message["livraison"][k]
		end
	end
	for k, v in pairs(global_http_error_message["type_adresse"]) do
		if global_http_error_message["type_adresse"][k] ~= nil then
			global_select_section["type_adresse"][k] = global_http_error_message["type_adresse"][k]
		end
	end
	for k, v in pairs(global_http_error_message["motif_litige"]) do
		if global_http_error_message["motif_litige"][k] ~= nil then
			global_select_section["motif_litige"][k] = global_http_error_message["motif_litige"][k]
		end
	end
	global_select_section["adresse"][0] = ""
	for j=0, #global_filtre_liste["adresse"] do
		if global_filtre_liste["adresse"][j] ~= nil then
			global_select_section["adresse"][global_filtre_liste["adresse"][j]["nom"]] = global_filtre_liste["adresse"][j]["nom"]
		end
	end
end