page104 = basalt.createFrame()
x, y = term.getSize()

page104:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"UPDATE"/2), 2)
    :setText("UPDATE")
    :setSize(#"UPDATE",1)

local logUpdater = page104:addFrame()
    :setSize(40, 10)
    :setPosition(1 + (x/2) - 20, 7)

page104:addButton()
    :setPosition(43, 5)
    :setText("mise a jour")
    :setSize(8,1)
    :onClick(function()
        local function getFilesInFolder(path)
            local files = {}
            for i, v in pairs(fs.list(path)) do
                if fs.isDir(path..v) then
                    for i2, v2 in pairs(getFilesInFolder(path..v.."/")) do
                        table.insert(files, v.."/"..v2)
                    end
                else
                    table.insert(files, v)
                end
            end
            return files
        end
        _files = getFilesInFolder("/")
        for i=#_files, 1, -1 do
            -- if file start by "rom" --> next
            if string.sub(_files[i], 1, 3) == "rom" then
                table.remove(_files, i)
            end
        end
        local _update = api.getLuaBySysteme(config.systemName)
        local changeCompteur = 0
        for i=1, #_files do
            if _update["/" .. _files[i]] == nil then
                fs.delete(_files[i])
                logUpdater:addLabel():setPosition(2, 1 + changeCompteur):setText(_files[i] .. " supprimer")
            else
                local _hashFile = sha256(fs.open(_files[i], "r").readAll())
                if _update["/" .. _files[i]] ~= _hashFile then
                    if fs.exists(_files[i]) then
                        logUpdater:addLabel():setPosition(2, 1 + changeCompteur):setText(_files[i] .. " mise a jour")
                    else
                        logUpdater:addLabel():setPosition(2, 1 + changeCompteur):setText(_files[i] .. " telecharger")
                    end
                    api.download(_files[i])
                else
                    logUpdater:addLabel():setPosition(2, 1 + changeCompteur):setText(_files[i] .. " a jour")
                end
            end
        end
        if changeCompteur == 0 then
            logUpdater:addLabel():setPosition(2, 1):setText("aucune mise a jour")
        else
            logUpdater:addLabel():setPosition(2, 1 + changeCompteur):setText("fin des mises a jour")
            logUpdater:addButton()
                :setPosition(2, 1 + changeCompteur + 1)
                :setText("reboot systeme")
                :onClick(function()
                    os.reboot()
                end)
        end
    end)

page104:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page101:show()
    end)

local timeLabel = page104:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page104TimeThread = page104:addThread()
page104TimeThread:start(function()
    page104alertTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page104alertTempo > 0 then
            page104alertTempo = page104alertTempo - 1
            if page104alertTempo == 0 then
                page104alert:remove()
            end
        end
    end
end)