package me.cristaling.webtest;

import me.cristaling.webtest.services.LoginService;
import me.cristaling.webtest.utils.JdbcUtils;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

import java.io.FileReader;
import java.io.IOException;
import java.util.Properties;

@SpringBootApplication
public class WebtestApplication {

	public static void main(String[] args) {
		SpringApplication.run(WebtestApplication.class, args);

		Properties serverProps = new Properties();
		try {
			serverProps.load(new FileReader("bd.config"));
		} catch (IOException e) {
			System.out.println("Cannot find bd.config "+e);
		}

		JdbcUtils jdbcUtils = new JdbcUtils(serverProps);
		new LoginService(jdbcUtils);
	}
}
