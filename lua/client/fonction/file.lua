function save_var_file(nom, data, name)
	local f = fs.open(nom, "w")
	f.write(name .. " = '" .. data .."'")
	f.close()
end
function save_table_file(nom, data, name)
	local f = fs.open(nom, "w")
	f.write(name .. " = " .. data .."")
	f.close()
end