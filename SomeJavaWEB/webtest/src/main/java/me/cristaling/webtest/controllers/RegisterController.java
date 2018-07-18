package me.cristaling.webtest.controllers;

import me.cristaling.webtest.controllers.requests.LoginRequest;
import me.cristaling.webtest.controllers.responses.LoginResponse;
import me.cristaling.webtest.core.User;
import me.cristaling.webtest.repositories.UserRepository;
import me.cristaling.webtest.services.LoginService;
import org.apache.tomcat.util.http.fileupload.IOUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

import javax.persistence.EntityNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.Arrays;
import java.util.List;
import java.util.UUID;

@CrossOrigin
@RestController
@RequestMapping("/api/register")
public class RegisterController {

	private UserRepository userRepository;

	@Autowired
	public RegisterController(UserRepository userRepository) {
		this.userRepository = userRepository;
	}

	@RequestMapping("/register1")
	public String register1() {
		return "/static/register1.html";
	}

	@RequestMapping("/register2")
	public String register2() {
		return "/static/register2.html";
	}

}
