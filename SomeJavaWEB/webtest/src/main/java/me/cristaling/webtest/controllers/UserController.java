package me.cristaling.webtest.controllers;

import me.cristaling.webtest.controllers.requests.LoginRequest;
import me.cristaling.webtest.controllers.requests.UUIDRequest;
import me.cristaling.webtest.controllers.responses.LoginResponse;
import me.cristaling.webtest.core.User;
import me.cristaling.webtest.repositories.UserRepository;
import me.cristaling.webtest.services.LoginService;
import me.cristaling.webtest.utils.UUIDUtils;
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
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Comparator;
import java.util.Date;
import java.util.List;
import java.util.UUID;

@CrossOrigin
@RestController
@RequestMapping("/api/user")
public class UserController {

	private UserRepository userRepository;

	@Autowired
	public UserController(UserRepository userRepository) {
		this.userRepository = userRepository;
		User user = new User();
		user.setUuid(UUID.randomUUID());
		user.setUsername("cristaling1");
		user.setPassword("asdf1");
		user.setEmail("a1@b1.com");
		user.setRandom("qwert");
		user.setRegisterDate(new Date());
		user.setLastLoginDate(new Date());
		userRepository.save(user);
		user = new User();
		user.setUuid(UUID.randomUUID());
		user.setUsername("cristaling2");
		user.setPassword("asdf2");
		user.setEmail("a3@b1.com");
		user.setRandom("qwert");
		user.setRegisterDate(new Date());
		user.setLastLoginDate(new Date());
		userRepository.save(user);
		user = new User();
		user.setUuid(UUID.randomUUID());
		user.setUsername("cristaling3");
		user.setPassword("asdf3");
		user.setEmail("a2@b1.com");
		user.setRandom("qwert");
		user.setRegisterDate(new Date());
		user.setLastLoginDate(new Date());
		userRepository.save(user);

	}

	@RequestMapping("/login")
	public LoginResponse loginUser1(@RequestBody LoginRequest loginRequest) {
		LoginResponse response = new LoginResponse();
		String token = null;
		User user = null;
		try {
			user = userRepository.getUserByUsernameAndPassword(loginRequest.getUsername(), loginRequest.getPassword());
			if (user == null) {
				response.setSuccessful(false);
				return response;
			}
			token = user.getUuid().toString();
		} catch (EntityNotFoundException ex) {
			System.out.println("Not found");
		}
		if (token == null) {
			response.setSuccessful(false);
			return response;
		}
		user.setLastLoginDate(new Date());
		userRepository.save(user);
		response.setSuccessful(true);
		response.setToken(token);
		return response;
	}

	@RequestMapping("/getlast3")
	public List<User> getLastUsers(@RequestBody UUIDRequest request) {

		UUID token = UUIDUtils.getUUIDFromString(request.getToken());

		if (token == null) {
			return new ArrayList<>();
		}

		List<User> users = userRepository.getUsersByUuidNot(token);

		users.sort(new Comparator<User>() {
			@Override
			public int compare(User o1, User o2) {
				return (int) (o1.getLastLoginDate().getTime() - o2.getLastLoginDate().getTime());
			}
		});

		List<User> result = new ArrayList<>();

		for (int i = 0; i < 3 && i < users.size(); i++) {
			result.add(users.get(i));
		}

		return result;
	}

	@RequestMapping("/delete")
	public void deleteUser(@RequestBody UUIDRequest request) {
		userRepository.deleteById(UUID.fromString(request.getToken()));
	}

	/*@RequestMapping("/login")
	public LoginResponse loginUser(@RequestBody LoginRequest loginRequest) {
		LoginResponse response = new LoginResponse();
		String token = LoginService.getInstance().tryLogin(loginRequest.getUsername(), loginRequest.getPassword());
		if (token == null) {
			response.setSuccessful(false);
			return response;
		}
		response.setSuccessful(true);
		response.setToken(token);
		return response;
	}*/

	@PostMapping("/register")
	public ResponseEntity<?> register(
			@RequestParam("theFile") MultipartFile uploadfile,
			@RequestParam("username") String username,
			@RequestParam("password") String password,
			@RequestParam("email") String email,
			@RequestParam("random") String random) {


		if (uploadfile.isEmpty()) {
			return new ResponseEntity("please select a file!", HttpStatus.OK);
		}

		User user = new User();
		user.setUuid(UUID.randomUUID());
		user.setUsername(username);
		user.setPassword(password);
		user.setEmail(email);
		user.setRandom(random);
		user.setRegisterDate(new Date());
		user.setLastLoginDate(new Date());
		userRepository.save(user);

		try {
			saveUploadedFiles(Arrays.asList(uploadfile), username);
		} catch (IOException e) {
			return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
		}

		return new ResponseEntity("Successfully uploaded - " +
				uploadfile.getOriginalFilename(), new HttpHeaders(), HttpStatus.OK);
	}

	/*@PostMapping("/change")
	public ResponseEntity<?> uploadFile(
			@RequestParam("file") MultipartFile uploadfile,
			@RequestParam("user") String userUUID,
			@RequestParam("password") String password) {

		User user = userRepository.getOne(UUID.fromString(userUUID));
		user.setPassword(password);
		userRepository.save(user);

		if (uploadfile.isEmpty()) {
			return new ResponseEntity("please select a file!", HttpStatus.OK);
		}

		try {
			saveUploadedFiles(Arrays.asList(uploadfile), userUUID);
		} catch (IOException e) {
			return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
		}

		return new ResponseEntity("Successfully uploaded - " +
				uploadfile.getOriginalFilename(), new HttpHeaders(), HttpStatus.OK);
	}*/

	private void saveUploadedFiles(List<MultipartFile> files, String name) throws IOException {
		for (MultipartFile file : files) {
			if (file.isEmpty()) {
				continue; //next pls
			}
			byte[] bytes = file.getBytes();
			Path path = Paths.get(name + ".png"/*file.getOriginalFilename()*/);
			Files.write(path, bytes);
		}

	}

	@GetMapping(value = "/image")
	public @ResponseBody
	byte[] getImage(String name) throws IOException {
		Path path = Paths.get(name + ".png");
		InputStream in;
		if (Files.exists(path)) {
			in = Files.newInputStream(path);
		} else {
			in = Files.newInputStream(Paths.get("Cipri.png"));
		}
		byte[] buffer = new byte[in.available()];
		IOUtils.readFully(in, buffer);
		return buffer;
	}

}
