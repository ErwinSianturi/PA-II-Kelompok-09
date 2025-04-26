package main

import (
	"flutter_api/database"
	"flutter_api/routes"
	"github.com/gin-gonic/gin"
)

func main() {
	db.InitDB()
	r := gin.Default()
	routes.AuthRoutes(r)
	r.Run(":8080")
}
