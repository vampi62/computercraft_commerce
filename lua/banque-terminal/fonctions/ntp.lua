-- deprecated

local function syncServTime()
    local newTime = api.getNtp()
    if newTime then
        serverTime = newTime
        serverTimeToString()
        return true
    end
    return false
end

local function updateTime()
    while true do
        serverTime.seconde = serverTime.seconde + 1
        sleep(1)
        if serverTime.seconde == 60 then
            serverTime.seconde = 0
            serverTime.minute = serverTime.minute + 1
            if serverTime.minute == 60 then
                serverTime.minute = 0
                syncServTime()
            end
            serverTimeToString()
        end
    end
end

local function serverTimeToString()
    local str = ""
    if serverTime.jour < 10 then
        str = str .. "0"
    end
    str = str .. serverTime.jour .. "/"
    if serverTime.mois < 10 then
        str = str .. "0"
    end
    str = str .. serverTime.mois .. "/" .. serverTime.annee .. " "
    if serverTime.heure < 10 then
        str = str .. "0"
    end
    str = str .. serverTime.heure .. ":"
    if serverTime.minute < 10 then
        str = str .. "0"
    end
    str = str .. serverTime.minute
    timeStr = str
end

local serverTime = {heure = 0, minute = 0, seconde = 0, jour = 1, mois = 1, annee = 1970}
local timeStr = "01/01/1970 00:00"
ntp = {
    syncServTime = syncServTime,
    updateTime = updateTime,
    timeStr = timeStr,
    serverTime = serverTime
}
timeLabel = {}