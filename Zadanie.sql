SELECT 
  DISTINCT(visited_on),
  ROUND((
   SELECT AVG(traf.time_spent)
   FROM traffic AS traf
   INNER JOIN users ON users.id = traf.user_id
   WHERE 
     users.user_type = 'user'
     AND traf.visited_on <= traffic.visited_on
     AND traf.visited_on > DATE_SUB(traffic.visited_on, INTERVAL 3 DAY)
  ), 4) as avg_time_spent

FROM traffic
INNER JOIN users ON users.id = traffic.user_id
WHERE users.user_type = 'user'

ORDER BY visited_on