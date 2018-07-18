package me.cristaling.webtest.controllers;

import me.cristaling.webtest.controllers.requests.UUIDRequest;
import me.cristaling.webtest.core.Answer;
import me.cristaling.webtest.core.Question;
import me.cristaling.webtest.repositories.AnswerRepository;
import me.cristaling.webtest.repositories.QuestionRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.UUID;

@CrossOrigin
@RestController
@RequestMapping("/api/answer")
public class AnswerController {

	private QuestionRepository questionRepository;
	private AnswerRepository answerRepository;

	@Autowired
	public AnswerController(QuestionRepository questionRepository, AnswerRepository answerRepository) {
		this.questionRepository = questionRepository;
		this.answerRepository = answerRepository;
	}

	@RequestMapping("/add")
	public Answer addAnswer(@RequestBody Answer answer) {
		answer.setUuid(UUID.randomUUID());
		answerRepository.save(answer);
		return answer;
	}

	@RequestMapping("/getfor")
	public List<Answer> getAnswers(@RequestBody UUIDRequest request) {
		return answerRepository.getAnswersByQuestion(UUID.fromString(request.getToken()));
	}

}
