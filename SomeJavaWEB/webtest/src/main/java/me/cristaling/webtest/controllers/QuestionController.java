package me.cristaling.webtest.controllers;

import me.cristaling.webtest.controllers.requests.LoginRequest;
import me.cristaling.webtest.controllers.responses.LoginResponse;
import me.cristaling.webtest.core.Question;
import me.cristaling.webtest.core.User;
import me.cristaling.webtest.repositories.QuestionRepository;
import me.cristaling.webtest.repositories.UserRepository;
import me.cristaling.webtest.services.LoginService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import javax.persistence.EntityNotFoundException;
import java.util.List;
import java.util.UUID;

@CrossOrigin
@RestController
@RequestMapping("/api/question")
public class QuestionController {

	private QuestionRepository questionRepository;

	@Autowired
	public QuestionController(QuestionRepository questionRepository) {
		this.questionRepository = questionRepository;
	}

	@RequestMapping("/add")
	public Question addQuestion(@RequestBody Question question) {
		question.setUuid(UUID.randomUUID());
		questionRepository.save(question);
		return question;
	}

	@RequestMapping("/getall")
	public List<Question> getQuestions() {
		return questionRepository.findAll();
	}

}
