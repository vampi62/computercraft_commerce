function save_file(nom, data)
	local f = fs.open(nom, "w")
	f.write(textutils.serialize(data))
	f.close()
end
function load_file(nom)
	local f = fs.open(nom, "r")
	local data = textutils.unserialize(f.readAll())
	f.close()
	return data
end