function resync_select()
	global_select_section = {
		type = {},
		livraison = {},
		type_adresse = {},
		motif_litige = {},
		adresse = {}
	}
	for j=0, #global_http_error_message["type"] do
		if global_http_error_message["type"][j] ~= nil then
			global_select_section["type"][j] = {}
			global_select_section["type"][j]["text"] = global_http_error_message["type"][j]
			global_select_section["type"][j]["valeur"] = j
		end
	end
	for j=0, #global_http_error_message["livraison"] do
		if global_http_error_message["livraison"][j] ~= nil then
			global_select_section["livraison"][j] = {}
			global_select_section["livraison"][j]["text"] = global_http_error_message["livraison"][j]
			global_select_section["livraison"][j]["valeur"] = j
		end
	end
	for j=0, #global_http_error_message["type_adresse"] do
		if global_http_error_message["type_adresse"][j] ~= nil then
			global_select_section["type_adresse"][j] = {}
			global_select_section["type_adresse"][j]["text"] = global_http_error_message["type_adresse"][j]
			global_select_section["type_adresse"][j]["valeur"] = j
		end
	end
	for j=0, #global_http_error_message["motif_litige"] do
		if global_http_error_message["motif_litige"][j] ~= nil then
			global_select_section["motif_litige"][j] = {}
			global_select_section["motif_litige"][j]["text"] = global_http_error_message["motif_litige"][j]
			global_select_section["motif_litige"][j]["valeur"] = j
		end
	end
	global_select_section["adresse"][0] = {}
	global_select_section["adresse"][0]["text"] = ""
	global_select_section["adresse"][0]["valeur"] = "0"
	for j=1, #global_filtre_liste["adresse"] do
		global_select_section["adresse"][j] = {}
		global_select_section["adresse"][j]["text"] = global_filtre_liste["adresse"][j]["nom"]
		global_select_section["adresse"][j]["valeur"] = global_filtre_liste["adresse"][j]["id"]
	end
end