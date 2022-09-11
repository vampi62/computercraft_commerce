function convert_grand_nombre(nombre)
	nombre = tonumber(nombre)
    if nombre > 1000000000 then
        return tostring(nombre/1000000000 .. "B")
    end
    if nombre > 1000000 then
        return tostring(nombre/1000000 .. "M")
    end
    if nombre > 1000 then
        return tostring(nombre/1000 .. "K")
    end
    return tostring(nombre)
end