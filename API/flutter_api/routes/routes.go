package routes

import (
	"flutter_api/controllers"
	"flutter_api/database"
	"fmt"
	"github.com/gin-gonic/gin"
)

func SetupRoutes(router *gin.Engine) {

	// Mendapatkan koneksi database
	db := database.GetDB()
	if db == nil {
		panic("Gagal mendapatkan koneksi database")
	}
	fmt.Println("Database berhasil diinisialisasi di routes.go")

	authController := controllers.AuthController{}
	router.POST("/register", authController.Register)
	router.POST("/login", authController.Login)

	profileController := controllers.ProfileController{}
	router.POST("/profile", profileController.CreateProfile)
	router.PUT("/profile/:user_id", profileController.UpdateProfile)

	workExperienceController := controllers.NewWorkExperienceController(db)
	router.POST("/user/:userId/work-experience", workExperienceController.CreateUserWorkExperience)
	router.GET("/user/:userId/work-experiences", workExperienceController.GetUserWorkExperiences)

	router.POST("/work-experiences", workExperienceController.Create)
	router.GET("/work-experiences", workExperienceController.GetAll)
	router.GET("/work-experiences/:id", workExperienceController.GetByID)
	router.PUT("/work-experiences/:id", workExperienceController.Update)
	router.DELETE("/work-experiences/:id", workExperienceController.Delete)

	educationController := controllers.NewEducationController(db)
	router.POST("/education", educationController.AddEducation)
	router.GET("/educations", educationController.GetAllEducations)
	router.POST("/help-requests", controllers.CreateHelpRequest) 
}
