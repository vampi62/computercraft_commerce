function change_color_champ_select(champ)
    if champ == global_edit_variable["nom"] then
        return 128
    else
        return 0
    end
end