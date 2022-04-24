function monitordetect()
    while run_prog do
        local e, side, x, y = os.pullEvent("monitor_touch")
        for j = 1, nbr_box_dispo do
            if side == monitor_box[j] then
                xbox[j] = x
                ybox[j] = y
            end
        end
        -- moniteur externe a realiser
    end
end