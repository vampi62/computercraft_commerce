function majFichierParUrl(fichier,url)
	if fs.exists(fichier) then
		fs.delete(fichier)
	end
	print(fichier.." < "..url)
	local content = http.get(url)
	local file = fs.open(fichier,"w")
	file.write(content.readAll())
	file.close()
end
