function router(numero_box)
    if pagebox[numero_box] == 0 then
        if xbox[numero_box] < 10 and ybox[numero_box] == 1 then -- inscription
            return 10
        end
        if xbox[numero_box] < 10 and ybox[numero_box] == 1 then -- login
            return 20
        end
    end
    if pagebox[numero_box] == 10 then

    end
end