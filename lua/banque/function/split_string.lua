function split(astring, delimiter)
    local result = {}
    local from = 1
    local delim_from, delim_to = string.find( astring, delimiter, from )
    while delim_from do
      table.insert(result, string.sub( astring, from , delim_from-1 ) )
      from = delim_to + 1
      delim_from, delim_to = string.find( astring, delimiter, from )
    end
    table.insert(result,string.sub(astring,from))
    return result
  end