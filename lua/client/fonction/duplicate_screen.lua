function duplicate_screen(ecran1, ecran2)
	local both = {}
	setmetatable(both, {
		__index = function(_, k)
			if (type(ecran1[k]) == "function") then
				return function(...)
					pcall(ecran1[k], ...)
					return ecran2[k](...)
				end
			else
				return ecran1[k]
			end
		end,
		__call = function(_, f, ...)
			pcall(ecran2[f], ...)
			return ecran1[f](...)
		end,
		__newindex = function(_, k, v)
			ecran1[k] = v
			ecran2[k] = v
		end
	})
	return both
end