function convert_grand_nombre(nombre)
	if nombre == "" or nombre == nil then
		nombre = 0
	end
	nombre = math.floor(tonumber(nombre)*100)/100
	if nombre >= 1000000000 then
		return tostring(nombre/1000000000) .. "B"
	end
	if nombre >= 1000000 then
		return tostring(nombre/1000000) .. "M"
	end
	if nombre >= 1000 then
		return tostring(nombre/1000) .. "K"
	end
	return tostring(nombre)
end