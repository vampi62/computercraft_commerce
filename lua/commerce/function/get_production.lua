function get_me_objet(me_controle,fingerprint_objet)
    local melist = me_controle.getAvailableItems()
    for a = 1, #melist do
        if melist[a].fingerprint.id == fingerprint_objet then
            return melist[a].size
        end
    end
    return 0
end
function get_tank_objet()

end